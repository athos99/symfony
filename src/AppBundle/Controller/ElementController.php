<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Element;
use AppBundle\Form\ElementType;

/**
 * Element controller.
 *
 * @Route("/element")
 */
class ElementController extends Controller
{
    /**
     * Lists all Element entities.
     *
     * @Route("/", name="element_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $elements = $em->getRepository('AppBundle:Element')->findAll();

        return $this->render('element/index.html.twig', array(
            'elements' => $elements,
        ));
    }

    /**
     * Creates a new Element entity.
     *
     * @Route("/new", name="element_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $element = new Element();
        $form = $this->createForm('AppBundle\Form\ElementType', $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            return $this->redirectToRoute('element_show', array('id' => $element->getId()));
        }

        return $this->render('element/new.html.twig', array(
            'element' => $element,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Element entity.
     *
     * @Route("/{id}", name="element_show")
     * @Method("GET")
     */
    public function showAction(Element $element)
    {
        $deleteForm = $this->createDeleteForm($element);

        return $this->render('element/show.html.twig', array(
            'element' => $element,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Element entity.
     *
     * @Route("/{id}/edit", name="element_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Element $element)
    {
        $deleteForm = $this->createDeleteForm($element);
        $editForm = $this->createForm('AppBundle\Form\ElementType', $element);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            return $this->redirectToRoute('element_edit', array('id' => $element->getId()));
        }

        return $this->render('element/edit.html.twig', array(
            'element' => $element,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Element entity.
     *
     * @Route("/{id}", name="element_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Element $element)
    {
        $form = $this->createDeleteForm($element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($element);
            $em->flush();
        }

        return $this->redirectToRoute('element_index');
    }

    /**
     * Creates a form to delete a Element entity.
     *
     * @param Element $element The Element entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Element $element)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('element_delete', array('id' => $element->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
