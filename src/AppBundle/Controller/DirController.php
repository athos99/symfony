<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Dir;
use AppBundle\Form\DirType;

/**
 * Dir controller.
 *
 * @Route("/dir")
 */
class DirController extends Controller
{
    /**
     * Lists all Dir entities.
     *
     * @Route("/", name="dir_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dirs = $em->getRepository('AppBundle:Dir')->findAll();

        return $this->render('dir/index.html.twig', array(
            'dirs' => $dirs,
        ));
    }

    /**
     * Creates a new Dir entity.
     *
     * @Route("/new", name="dir_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dir = new Dir();
        $form = $this->createForm('AppBundle\Form\DirType', $dir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dir);
            $em->flush();

            return $this->redirectToRoute('dir_show', array('id' => $dir->getId()));
        }

        return $this->render('dir/new.html.twig', array(
            'dir' => $dir,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Dir entity.
     *
     * @Route("/{id}", name="dir_show")
     * @Method("GET")
     */
    public function showAction(Dir $dir)
    {
        $deleteForm = $this->createDeleteForm($dir);

        return $this->render('dir/show.html.twig', array(
            'dir' => $dir,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dir entity.
     *
     * @Route("/{id}/edit", name="dir_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dir $dir)
    {
        $deleteForm = $this->createDeleteForm($dir);
        $editForm = $this->createForm('AppBundle\Form\DirType', $dir);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dir);
            $em->flush();

            return $this->redirectToRoute('dir_edit', array('id' => $dir->getId()));
        }

        return $this->render('dir/edit.html.twig', array(
            'dir' => $dir,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dir entity.
     *
     * @Route("/{id}", name="dir_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dir $dir)
    {
        $form = $this->createDeleteForm($dir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dir);
            $em->flush();
        }

        return $this->redirectToRoute('dir_index');
    }

    /**
     * Creates a form to delete a Dir entity.
     *
     * @param Dir $dir The Dir entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dir $dir)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dir_delete', array('id' => $dir->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
