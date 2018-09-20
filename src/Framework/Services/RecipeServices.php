<?php

namespace App\Framework\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RecipeServices
{
    const RESPONSE_OK = 200;

    /** @var \GuzzleHttp\Client $client */
    protected $client;

    public function __construct(ContainerInterface $container)
    {
        $this->client = $container->get('eight_points_guzzle.client.api_recipes_puppy');
    }

    public function searchRecipesBySearchQuery($query, $page = null)
    {
        $queryParams = ['q' => $query];

        if($page) {
            $queryParams['p'] = (int)$page;
        }

        $response = $this->client->request('GET', '', [
            'query' => $queryParams
        ]);

        if(self::RESPONSE_OK === $response->getStatusCode()) {
            return json_decode($response->getBody()->getContents());
        }

        return null;
    }
}