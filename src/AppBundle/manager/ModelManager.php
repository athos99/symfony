<?php
/**
 * Created by PhpStorm.
 * User: ux32vd
 * Date: 29.11.2015
 * Time: 22:20
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;

class ModelManager
{
    /**
     * @var EntityManager $em
     */
    public $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addCategory( $name) {
        $category = $this->getCategory($name);
        if ( $category == null) {
            $category = new Category();
            $category->setName($name);
            $this->em->persist($category);
            $this->em->flush();
        }
        return $category;
    }

    public function getCategory( $name) {
        $categoryRepository = $this->em->getRepository('AppBundle:Category');
        $category = $categoryRepository->findOneBy(['name'=>$name]);
        return $category;
    }
}