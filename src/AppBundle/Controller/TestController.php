<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;


class TestController extends Controller {
  public function indexAction() {

    $links = array(
      array('href' => $this->generateUrl('test1'), 'text' => '<b>test1</b>'),
      array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

    );
    return $this->render('AppBundle:Test:index.html.twig',
      array('links' => $links));
  }

  public function index1Action() {
    $em = $this->getDoctrine()->getManager();
    $product = new Product();
    $product->setName('xxxx');
    $em->persist($product);
    $em->flush();
    $idProduct = $product->getId();


    $repository = $this->getDoctrine()->getRepository('AppBundle:Product');

    $product = $repository->find($idProduct);

    $product = $repository->findOneById($idProduct);
    $product = $repository->findOneByName('xxxx');

    $product = $em->getRepository('AppBundle:Product')->find($idProduct);
    $product->setName('yyyy');
    $em->flush();

    $links = array(
      array('href' => $this->generateUrl('test1'), 'text' => '<b>test1</b>'),
      array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

    );
    return $this->render('AppBundle:Test:index.html.twig',
      array('links' => $links));
  }

  public function index2Action() {

    $links = array(
      array('href' => $this->generateUrl('test1'), 'text' => '<b>test1</b>'),
      array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

    );
    return $this->render('AppBundle:Test:index.html.twig',
      array('links' => $links));
  }

}
