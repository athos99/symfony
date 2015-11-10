<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {

        $tests = array('url' => $this->generateUrl(          'blog_show',          array('slug' => 'my-blog-post')        ));
        return $this->render('AppBundle:Test:index.html.twig', array(
                // ...
            ));    }

}
