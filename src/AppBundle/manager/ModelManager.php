<?php
/**
 * Created by PhpStorm.
 * User: ux32vd
 * Date: 29.11.2015
 * Time: 22:20
 */

namespace AppBundle\Manager;


use Doctrine\ORM\EntityManager;

class ModelManager
{
    /**
     * @var EntityManager $em
     */
    public $em;


    public function __construct(EntityManageranager $em)
    {
        $this->em = $em;
    }
}