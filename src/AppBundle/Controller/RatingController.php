<?php
/**
 * Rating controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Website;
use AppBundle\Form\WebsiteType;
use AppBundle\Repository\WebsiteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use AppBundle\Form\RatingType;
use AppBundle\Entity\Rating;
use AppBundle\Repository\RatingRepository;


/**
 * Class RatingController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/rating")
 */
class RatingController extends Controller
{
    /**
     * Index action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="rating_index"
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="rating_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $ratings = $this->get('app.repository.rating')->findAllPaginated($page);

        return $this->render(
            'rating/index.html.twig',
            ['ratings' => $ratings]
        );
    }

    /**
     * View action.
     *
     * @param Rating $id
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @internal param Rating $rating Rating entity
     *
     * @Route(
     *     "/{id}",
     *     requirements={"id": "[1-9]\d*"},
     *     name="category_view",
     * )
     * @Method("GET")
     */
    public function viewAction(Rating $id)
    {
        $rating = $this->get('app.repository.rating')->findOneById($id);


        $websites = $this->get('app.repository.website')->findByRating($id);



        return $this->render(
            'rating/view.html.twig',
            ['rating' => $rating,
                'websites' => $websites]
        );
    }

    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="rating_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.rating')->save($rating);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('app_page_index');
        }

        return $this->render(
            'rating/add.html.twig',
            [
                'rating' => $rating,
                'form' => $form->createView()
            ]
        );
    }
}