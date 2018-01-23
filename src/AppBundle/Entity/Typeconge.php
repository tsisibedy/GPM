<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeconge
 *
 * @ORM\Table(name="typeconge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypecongeRepository")
 */
class Typeconge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typeconge_name", type="string", length=255)
     */
    private $typecongeName;

    /**
     * @var bool
     *
     * @ORM\Column(name="typeconge_status", type="boolean")
     */
    private $typecongeStatus;


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
     * Set typecongeName
     *
     * @param string $typecongeName
     * @return Typeconge
     */
    public function setTypecongeName($typecongeName)
    {
        $this->typecongeName = $typecongeName;

        return $this;
    }

    /**
     * Get typecongeName
     *
     * @return string 
     */
    public function getTypecongeName()
    {
        return $this->typecongeName;
    }

    /**
     * Set typecongeStatus
     *
     * @param boolean $typecongeStatus
     * @return Typeconge
     */
    public function setTypecongeStatus($typecongeStatus)
    {
        $this->typecongeStatus = $typecongeStatus;

        return $this;
    }

    /**
     * Get typecongeStatus
     *
     * @return boolean 
     */
    public function getTypecongeStatus()
    {
        return $this->typecongeStatus;
    }
}
