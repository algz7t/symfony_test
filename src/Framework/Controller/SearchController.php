<?php
namespace App\Framework\Controller;

use App\Framework\Services\RecipeServices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class SearchController extends Controller
{
    /** @var RecipeServices $recipeServices */
    protected $recipeServices;

    public function __construct(RecipeServices $recipeServices)
    {
        $this->recipeServices = $recipeServices;
    }

    /**
     * @Route("/search", name="search")
     */
    public function getSearchAction(Request $request)
    {
        return $this->recipeServices->searchRecipesBySearchQuery("omelet");
        return $this->json(array('username' => 'jane.doe'));
    }
}