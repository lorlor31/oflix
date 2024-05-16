composer install
créer .env.local et laisser en env de dev pour les fixtures
mdb 675aac68
pub 811d252689cb312f1f80ee13d4a3dc3a 5ce4e48f2e4318b828f750329ccb0b05

bin/console doctrine:database:create
bin/console doctrine:migration:migrate
bin/console doctrine:fixtures:load

lancer

bin/console  app:update-poster
