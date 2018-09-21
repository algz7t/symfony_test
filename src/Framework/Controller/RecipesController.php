<?php
namespace App\Framework\Controller;

use App\Data\RecipeCategories;
use App\Framework\Services\RecipeFormatter;
use App\Framework\Services\RecipeServices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class RecipesController extends Controller
{
    /** @var RecipeServices $recipeServices */
    protected $recipeServices;
    /** @var RecipeFormatter $recipesFormmatter */
    protected $recipesFormmatter;

    public function __construct(RecipeServices $recipeServices, RecipeFormatter $formatter)
    {
        $this->recipeServices = $recipeServices;
        $this->recipesFormmatter = $formatter;
    }

    /**
     * @Route("/recipes", name="recipes")
     * @QueryParam(name="category", default="0", nullable=true, allowBlank=true,  requirements="\w+", strict=true, description="category")
     * @QueryParam(name="p", default="0", nullable=true, allowBlank=true,  requirements="\d+", strict=true, description="p")
     * @param Request $request
     * @param RecipeFormatter $formatter
     * @return JsonResponse
     */
    public function getRecipesAction(Request $request)
    {
        $categoryQueryParam = $request->get('category');
        $page = $request->get('p');
        $categoryQueryParam = str_replace('&', 'and', $categoryQueryParam);
        if(!RecipeCategories::exists($categoryQueryParam)) {
            throw new BadRequestHttpException("Category doesn't exist");
        }

        $results = $this->recipeServices->searchRecipesBySearchQuery($categoryQueryParam, $page);
        $results = $this->recipesFormmatter->setNutritionalFacts($results);

        return  new JsonResponse($results);
    }
}