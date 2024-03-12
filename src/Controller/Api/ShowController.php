<?php

namespace App\Controller\Api;

use App\Entity\Casting;
use App\Entity\Person;
use App\Entity\Show;
use App\Repository\ShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ShowController extends AbstractController
{
    #[Route('/api/shows', name: 'app_api_show_list', methods: ['GET'])]
    public function list(ShowRepository $showRepository): JsonResponse
    {
        //  appeler les films en bdd
        return $this->json($showRepository->findAll(), Response::HTTP_OK, [], [
            "groups" => ["show", "castingLinked", "reviewLinked", "userLinked", "seasonLinked", "genreLinked"]
        ]);
    }

    #[Route('/api/shows/{id}', name: 'app_api_show_read', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function read(Show $show): JsonResponse
    {
        //  appeler les films en bdd
        return $this->json($show, Response::HTTP_OK, [], [
            "groups" => ["show", "castingLinked", "reviewLinked", "userLinked", "seasonLinked", "genreLinked"]
        ]);
    }

    #[Route('/api/shows/random', name: 'app_api_show_random', methods: ['GET'])]
    public function random(ShowRepository $showRepository): JsonResponse
    {
        //  appeler les films en bdd
        return $this->json($showRepository->findOneRandom(), Response::HTTP_OK);
    }

    #[Route('/api/shows', name: 'app_api_show_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {

        // je récupère le json en brut dans la requête
        $data = $request->getContent();

        //  gérer le cas ou le json n'est pas au bon format
        try {
            // je transforme le json brut en entité show
            // ici si un genre est passé le customDenormalizer va se déclencher
            $show = $serializer->deserialize($data, Show::class, 'json');
        } catch (NotEncodableValueException $exception) {
            return $this->json([
                "error" =>
                ["message" => $exception->getMessage()]
            ], Response::HTTP_BAD_REQUEST);
        }

        // on check s'il y a des erreurs de validations
        $errors = $validator->validate($show);
        if (count($errors) > 0) {

            $dataErrors = [];
            // si je suis la c'est que j'ai forcement un tableau d'erreur donc je boucle dessus
            foreach ($errors as $error) {
                // j'ajoute le message d'erreur à l'index correspondant à l'attribut ou il y a un soucis
                $dataErrors[$error->getPropertyPath()] = $error->getMessage();
            }

            return $this->json(["error" => ["message" => $dataErrors]], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($show);

        $entityManager->flush();
        //  appeler les films en bdd
        return $this->json($show, Response::HTTP_CREATED, ["Location" => $this->generateUrl("app_api_show_read", ["id" => $show->getId()])], [
            "groups" => ["show", "castingLinked", "reviewLinked", "userLinked", "seasonLinked", "genreLinked"]
        ]);
    }
}
