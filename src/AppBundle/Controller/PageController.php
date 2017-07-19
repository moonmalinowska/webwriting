<?php
/**
 * Page controller class.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Website;


/**
 * Class PageController.
 *
 * @package AppBundle\Controller
 * @link http://leszczyna.wzks.uj.edu.pl/~12_malinowska/projekt-mgr/
 * @author Monika Malinowska
 * @copyright (c) 2017
 */
class PageController extends Controller
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route("/")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $categories = $this->get('app.repository.category')->findAll();
        
        $websites = $this->get('app.repository.website')->getLatestWebsites();


        return $this->render(
            'page/index.html.twig',
            ['categories' => $categories,
            'websites' => $websites]
        );
    }



}
