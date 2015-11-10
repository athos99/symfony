<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller {
  public function indexAction() {

    $tests = array(
      array('url' => $this->generateUrl('test1'), 'title' => 'test1'),
      array('url' => $this->generateUrl('test2'), 'title' => 'test2'),

    );
    return $this->render('AppBundle:Test:index.html.twig',
      array('links' => $tests));
  }

}
