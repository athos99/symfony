<?php

namespace AppBundle\Entity;

/**
 * Group
 */
class Group
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $permanent = '0';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dir;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dir = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set permanent
     *
     * @param boolean $permanent
     *
     * @return Group
     */
    public function setPermanent($permanent)
    {
        $this->permanent = $permanent;
    
        return $this;
    }

    /**
     * Get permanent
     *
     * @return boolean
     */
    public function getPermanent()
    {
        return $this->permanent;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add dir
     *
     * @param \AppBundle\Entity\Dir $dir
     *
     * @return Group
     */
    public function addDir(\AppBundle\Entity\Dir $dir)
    {
        $this->dir[] = $dir;
    
        return $this;
    }

    /**
     * Remove dir
     *
     * @param \AppBundle\Entity\Dir $dir
     */
    public function removeDir(\AppBundle\Entity\Dir $dir)
    {
        $this->dir->removeElement($dir);
    }

    /**
     * Get dir
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDir()
    {
        return $this->dir;
    }
}
