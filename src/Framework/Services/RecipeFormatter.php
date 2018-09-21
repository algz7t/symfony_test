<?php

namespace App\Framework\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RecipeFormatter
{
    public function __construct(ContainerInterface $container)
    {

    }

    public function setNutritionalFacts($recipes)
    {
       foreach($recipes as $index => $item) {
           $recipes[$index]['nutritional_facts'] = [];
       }

        return $recipes;
    }
}