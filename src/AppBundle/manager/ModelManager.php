<?php
/**
 * Created by PhpStorm.
 * User: ux32vd
 * Date: 29.11.2015
 * Time: 22:20
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

class ModelManager
{
    /**
     * @var EntityManager $em
     */
    public $em;


    public $categoryRepositiory;
    public $productRepositiory;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->categoryRepository = $this->em->getRepository(
          'AppBundle:Category'
        );
        $this->productRepository = $this->em->getRepository(
          'AppBundle:Product'
        );
    }




    public function commit() {
        $this->em->flush();
    }

    /**
     * @param string $name
     * @return Category
     */
    public function addCategory($name)
    {
        $category = $this->getCategory($name);
        if ($category == null) {
            $category = new Category();
            $category->setName($name);
            $this->em->persist($category);
        }
        return $category;
    }

    public function addProduct($name, $categoryName = null)
    {
        $category = null;
        if ($categoryName != null) {
            $category = $this->addCategory($categoryName);
        }
        $product = $this->getProduct($name);
        if ($product == null) {
            $product = new Product();
            $product->setName($name);
            $product->setPrice(0);
            $product->setCategory($category);
            $this->em->persist($product);
        } else {
            $product->setCategory($category);
        }
        return $product;
    }


    /**
     * @param string $name
     * @return Category
     */
    public function getCategory($name)
    {
        return $this->categoryRepository->findOneBy(['name' => $name]);
    }

    /**
     * @param string $name
     * @return product
     */
    public function getProduct($name)
    {
        return $this->productRepository->findOneBy(['name' => $name]);
    }


}