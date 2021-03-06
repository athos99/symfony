<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dir;
use AppBundle\Manager\ModelManager;
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
            'AppBundle:test:index.html.twig',
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
            'AppBundle:test:index.html.twig',
            array('data' => var_export($product, true))
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
            'AppBundle:test:index.html.twig',
            array('data' => print_r(null, true))
        );


    }

    function index3Action()
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findAllOrderedByName();

        $rep = $this->get('app.product_repository');
        $products = $rep->findAll();

        $modelManager = new ModelManager($em);
        $rep = $this->get('app.model_manager');

        return $this->render(
            'AppBundle:test:index.html.twig',
            array('data' => null)
        );
    }

    function index4Action()
    {
        /** @var Connection $conn */
        $conn = $this->get('database_connection');

        /* fetch all products */
        $products = $conn->fetchAll('SELECT * FROM product');

        /* simple */
        $sql = 'SELECT * FROM product';
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch()) {
            $product = $row;
        }


        /* simple with values */
        $sql = 'SELECT * FROM product WHERE id != :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', 0);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $a = $row;
        }

        /* simple with params */
        $id = 0;
        $sql = 'SELECT * FROM product WHERE id != :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $this->render(
            'AppBundle:test:index.html.twig',
            array('data' => null)
        );
    }

    function index5Action()
    {
        /** @var ModelManager $modelManager */
        $modelManager = $this->get('app.model_manager');

        $prod = $modelManager->getProduct('p1');


        $catA = $modelManager->addCategory('A');
        $catB = $modelManager->addCategory('B');
        $catC = $modelManager->addCategory('C');

        $prod1 = $modelManager->addProduct('p1', 'A');
        $prod2 = $modelManager->addProduct('p2', 'D');
        $prod3 = $modelManager->addProduct('p3', null);
        $prod4 = $modelManager->addProduct('p4', 'A');

        $modelManager->commit();


        $prod01 = $modelManager->getProduct('p1');
        $category = $prod01->getCategory();
        $p = [];
        $coll = $catA->getProducts();
        foreach ($coll as $product) {
            $p[] = $product;
        }

        return $this->render(
            'AppBundle:test:index.html.twig',
            array('data' => null)
        );
    }


    public function index6Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();


        $dir = new Dir();
        $dir->setName('aaaa');
        $em->persist($dir);
        $em->flush($dir);


        $dir2 = new Dir();
        $dir2->setName('bbbb');
        $dir2->setParent($dir);

        $em->persist($dir2);
        $em->flush($dir2);



        return $this->render(
          'AppBundle:test:index.html.twig',
          array('data' => var_export(1, true))
        );

    }


}
