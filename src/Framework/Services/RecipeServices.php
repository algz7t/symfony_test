<?php

namespace App\Framework\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RecipeServices
{
    /** @var \GuzzleHttp\Client $client */
    protected $client;

    public function __construct(ContainerInterface $container)
    {
        $this->client = $container->get('eight_points_guzzle.client.api_crm');
    }

    public function searchRecipesBySearchQuery($query)
    {
        return $this->client->get( '/', ['q' => $query]);
    }
}