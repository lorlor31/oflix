<?php

$films = [
    [
        'name'=> 'kljbrf 2000',
        'year'=> 2000,
    ],
    [
        'name'=> 'PIUJBAEFE 1989',
        'year'=> 1989,
    ],
    [
        'name'=> 've 2022',
        'year'=> 2022,
    ],
    [
        'name'=> 'mkjnaqiezbf 2120',
        'year'=> 2120,
    ],
];

var_dump($films);
usort($films, function($filmA, $filmB) {
    return strlen($filmA['name']) - strlen($filmB['name']);
});

var_dump($films);