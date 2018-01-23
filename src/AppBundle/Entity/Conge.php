<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table(name="conge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CongeRepository")
 */
class Conge
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
     * @var int
     *
     * @ORM\Column(name="conge_type", type="integer")
     */
    private $congeType;

    /**
     * @var string
     *
     * @ORM\Column(name="conge_date_start", type="string", length=255)
     */
    private $congeDateStart;

    /**
     * @var string
     *
     * @ORM\Column(name="conge_date_fin", type="string", length=255)
     */
    private $congeDateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="conge_date_create", type="string", length=255)
     */
    private $congeDateCreate;

    /**
     * @var bool
     *
     * @ORM\Column(name="conge_status", type="boolean")
     */
    private $congeStatus;

    /**
     * @var int
     *
     * @ORM\Column(name="conge_demandeur_id", type="integer")
     */
    private $congeDemandeurId;


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
     * Set congeDateStart
     *
     * @param string $congeDateStart
     * @return Conge
     */
    public function setCongeDateStart($congeDateStart)
    {
        $this->congeDateStart = $congeDateStart;

        return $this;
    }

    /**
     * Get congeDateStart
     *
     * @return string 
     */
    public function getCongeDateStart()
    {
        return $this->congeDateStart;
    }

    /**
     * Set congeDateFin
     *
     * @param string $congeDateFin
     * @return Conge
     */
    public function setCongeDateFin($congeDateFin)
    {
        $this->congeDateFin = $congeDateFin;

        return $this;
    }

    /**
     * Get congeDateFin
     *
     * @return string 
     */
    public function getCongeDateFin()
    {
        return $this->congeDateFin;
    }

    /**
     * Set congeStatus
     *
     * @param boolean $congeStatus
     * @return Conge
     */
    public function setCongeStatus($congeStatus)
    {
        $this->congeStatus = $congeStatus;

        return $this;
    }

    /**
     * Get congeStatus
     *
     * @return boolean 
     */
    public function getCongeStatus()
    {
        return $this->congeStatus;
    }

    /**
     * Set congeDemandeurId
     *
     * @param integer $congeDemandeurId
     * @return Conge
     */
    public function setCongeDemandeurId($congeDemandeurId)
    {
        $this->congeDemandeurId = $congeDemandeurId;

        return $this;
    }

    /**
     * Get congeDemandeurId
     *
     * @return integer 
     */
    public function getCongeDemandeurId()
    {
        return $this->congeDemandeurId;
    }

    /**
     * Set congeType
     *
     * @param integer $congeType
     * @return Conge
     */
    public function setCongeType($congeType)
    {
        $this->congeType = $congeType;

        return $this;
    }

    /**
     * Get congeType
     *
     * @return integer 
     */
    public function getCongeType()
    {
        return $this->congeType;
    }

    /**
     * Set congeDateCreate
     *
     * @param string $congeDateCreate
     * @return Conge
     */
    public function setCongeDateCreate($congeDateCreate)
    {
        $this->congeDateCreate = $congeDateCreate;

        return $this;
    }

    /**
     * Get congeDateCreate
     *
     * @return string 
     */
    public function getCongeDateCreate()
    {
        return $this->congeDateCreate;
    }
}
