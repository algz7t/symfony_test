<?php
namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * @Route("/api")
 */
class RecipesController extends Controller
{
    /**
     * @Route("/recipes", name="index")
     * @QueryParam
     */
    public function getRecipes()
    {
        return new JsonResponse();
    }
}