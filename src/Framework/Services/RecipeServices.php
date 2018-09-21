<?php

namespace App\Framework\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class RecipeServices
{
    const RESPONSE_OK = 200;
    const API_PAGING_QUERY_PARAMETER = 'p';
    const API_QUERYSEARCH_QUERY_PARAMETER = 'q';
    const API_INGREDIENTS_QUERY_PARAMETER = 'i';

    /** @var \GuzzleHttp\Client $client */
    protected $client;

    public function __construct(ContainerInterface $container)
    {
        $this->client = $container->get('eight_points_guzzle.client.api_recipes_puppy');
    }

    public function searchRecipesBySearchQuery($query, $page = null)
    {
        $queryParams = [self::API_QUERYSEARCH_QUERY_PARAMETER => $query];

        if($page) {
            $queryParams[self::API_PAGING_QUERY_PARAMETER] = (int)$page;
        }

        $response = $this->buildGetRequest($queryParams);

        if(self::RESPONSE_OK === $response->getStatusCode()) {
            return $this->extractResults($response->getBody()->getContents());
        }

        return null;
    }

    private function buildGetRequest($queryParams = [])
    {
        return $this->client->request(
            'GET',
            '',
            ['query' => $queryParams]
        );
    }

    private function extractResults($responseContent)
    {
        $decodedResponse = json_decode($responseContent, true);
        if(isset($decodedResponse['results'])) {
            return $decodedResponse['results'];
        }

        return null;
    }
}