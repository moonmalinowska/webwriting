<?php
/**
 * Category controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Website;


/**
 * Class CategoryController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="category_index",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $categories = $this->get('app.repository.category')->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * View action.
     *
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @internal param Category $category Category entity
     *
     * @Route(
     *     "/{id}",
     *     requirements={"id": "[1-9]\d*"},
     *     name="category_view",
     * )
     * @Method("GET")
     */
    public function viewAction(Category $id)
    {
        /**
        $categoryId = $this->get('app.repository.category')->getId();
        $websites = $this->get('app.repository.website')->findBy(array('category' => $categoryId)); //TU MUSI BYĆ ZNAJDŹ STRONY PO KATEGORII
*/

        $category = $this->get('app.repository.category')->findOneById($id);


        $websites = $this->get('app.repository.website')->findByCategory($id);



        return $this->render(
            'category/view.html.twig',
            ['category' => $category,
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
     *     name="category_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.category')->save($category);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('category_index');
        }

        return $this->render(
            'category/add.html.twig',
            ['category' => $category, 'form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\Category $category Category entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     requirements={"id": "[1-9]\d*"},
     *     name="category_edit",
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.category')->save($category);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('category_index');
        }

        return $this->render(
            'category/edit.html.twig',
            ['category' => $category, 'form' => $form->createView()]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\Category $category Category entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     requirements={"id": "[1-9]\d*"},
     *     name="category_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createForm(FormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.category')->delete($category);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('category_index');
        }

        return $this->render(
            'category/delete.html.twig',
            ['category' => $category, 'form' => $form->createView()]
        );
    }


}