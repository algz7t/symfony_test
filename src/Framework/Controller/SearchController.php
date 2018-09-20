<?php
namespace App\Framework\Controller;

use App\Framework\Services\RecipeServices;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * @Route("/api")
 */
class SearchController extends Controller
{
    const SAFE_STRING_REGEX = '/^[A-Za-z0-9._~(),;+?\-\s]+$/im';
    /** @var RecipeServices $recipeServices */
    protected $recipeServices;

    public function __construct(RecipeServices $recipeServices)
    {
        $this->recipeServices = $recipeServices;
    }

    /**
     * @Route("/search", name="search")
     * @QueryParam(name="q", default="0", nullable=true, allowBlank=true,  requirements="\w+", strict=true, description="search string")
     * @return JsonResponse
     */
    public function getSearchAction(Request $request)
    {
        $searchQueryString = $request->get('q');
        $page = $request->get('p');

        $regexMatchAll = preg_match_all(self::SAFE_STRING_REGEX, $searchQueryString);
        if(empty($searchQueryString) || !$regexMatchAll) {
            throw new BadRequestHttpException("Missing q query parameter");
        }

        $results = $this->recipeServices->searchRecipesBySearchQuery($searchQueryString, $page);

        return  new JsonResponse($results);
    }
}