<?php

namespace AppBundle\Controller;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\Validator\Mapping\Cache\DoctrineCache;


class TestController extends Controller
{
    public function indexAction()
    {


        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('data' => null)
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

        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('data' => var_export($product,true))
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
        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('data' => print_r(null,true))
        );


    }

    function index3Action() {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
          ->findAllOrderedByName();

        $rep = $this->get('app.product_repository');
        $products = $rep->findAll();
        return $this->render(
          'AppBundle:Test:index.html.twig',
          array('data' => null)
        );
    }
    function index4Action() {
        /** @var Connection $conn */
        $conn = $this->get('database_connection');
        $users = $conn->fetchAll('SELECT * FROM product');
        return $this->render(
            'AppBundle:Test:index.html.twig',
            array('data' => null)
        );
    }

}
