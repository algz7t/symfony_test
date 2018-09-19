<?php
namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class RecipesController extends Controller
{
    /**
     * @Route("/recipes", name="index")
     */
    public function getRecipes()
    {
        return $this->json(array('username' => 'jane.doe'));
    }
}