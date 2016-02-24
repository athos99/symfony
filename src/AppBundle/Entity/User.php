<?php

namespace AppBundle\Entity;

/**
 * User
 */
class User extends \FOS\UserBundle\Model\User
{


    /**
     * Object string value
     *
     * @return string
     */
    public function __toString()
    {
        return $this->username;
    }

}
