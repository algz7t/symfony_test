<?php
namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function getSearchAction(Request $request)
    {

        return $this->json(array('username' => 'jane.doe'));
    }
}