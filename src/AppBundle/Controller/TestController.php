<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
