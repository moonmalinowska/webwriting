<?php
/**
 * Website controller.
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
 * Class WebsiteController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/website")
 */
class WebsiteController extends Controller
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
     *     name="website_index"
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="website_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $websites = $this->get('app.repository.website')->findAllPaginated($page);

        return $this->render(
            'website/index.html.twig',
            ['websites' => $websites]
        );
    }

    /**
     * View action.
     *
     * @param Website $website Website entity
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     * @Route(
     *     "/{id}",
     *     requirements={"id": "[1-9]\d*"},
     *     name="website_view",
     * )
     * @Method({"GET", "POST"})
     */
    public function viewAction(Website $website, Request $request)
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
            'website/view.html.twig',
            ['website' => $website,
                'rating' => $rating,
                'form' => $form->createView()]
        );
/*
        return $this->render(
            'website/view.html.twig',
            ['website' => $website]
        );*/
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
     *     name="website_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.website')->save($website);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('app_page_index');
        }

        return $this->render(
            'website/add.html.twig',
            [
                'website' => $website,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\Website $website Website entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     requirements={"id": "[1-9]\d*"},
     *     name="website_edit",
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Website $website)
    {
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.website')->save($website);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('website_index');
        }

        return $this->render(
            'website/edit.html.twig',
            ['website' => $website, 'form' => $form->createView()]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\Website $website Website entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     requirements={"id": "[1-9]\d*"},
     *     name="website_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Website $website)
    {
        $form = $this->createForm(FormType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.website')->delete($website);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('website_index');
        }

        return $this->render(
            'website/delete.html.twig',
            ['website' => $website, 'form' => $form->createView()]
        );
    }

    /**
     * Ranking action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="website_ranking",
     * )
     * @Method("GET")
     */
    public function rankingAction()
    {

    }
}