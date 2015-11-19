<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;


class TestController extends Controller
{
    public function indexAction()
    {

        $links = array(
          array(
            'href' => $this->generateUrl('test1'),
            'text' => '<b>test1</b>',
          ),
          array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

        );

        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('links' => $links)
        );
    }

    public function index1Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName('xxxx');
        $product->setPrice(5.97);
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

        $em->remove($product);
        $em->flush();

        $links = array(
          array(
            'href' => $this->generateUrl('test1'),
            'text' => '<b>test1</b>',
          ),
          array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

        );

        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('links' => $links)
        );
    }

    public function index2Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('xxxx');
        $product->setPrice(5.97);
        $em->persist($product);
        $em->flush();

        $product = new Product();
        $product->setName('xxxx');
        $product->setPrice(30);
        $em->persist($product);
        $em->flush();

        $query = $em->createQuery(
          'SELECT p
          FROM AppBundle:Product p
          WHERE p.price > :price
          ORDER BY p.name ASC'
        )->setParameter('price', '19.99');

        $products = $query->getResult();
        $query = $em->createQuery(
          'DELETE
           FROM AppBundle:Product p
           WHERE p.name = :name'
        )->setParameter('name', 'xxxx');

        $products = $query->execute();


        $links = array(
          array(
            'href' => $this->generateUrl('test1'),
            'text' => '<b>test1</b>',
          ),
          array('href' => $this->generateUrl('test2'), 'text' => 'test2'),

        );

        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('links' => $links)
        );
    }

    function index3Action() {
        $products = $this->get('app.product_repository')->findAll();
    }

}
