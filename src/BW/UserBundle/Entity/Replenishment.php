<?php

namespace BW\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BW\UserBundle\Entity\Replenishment
 *
 * @ORM\Table(name="replenishments")
 * @ORM\Entity(repositoryClass="BW\UserBundle\Entity\ReplenishmentRepository")
 */
class Replenishment
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var decimal $additiveAmount
     *
     * @ORM\Column(name="additive_amount", type="decimal", precision=10, scale=4)
     */
    private $additiveAmount;

    /**
     * @var decimal $equivalentAmount
     *
     * @ORM\Column(name="equivalent_amount", type="decimal", precision=10, scale=4)
     */
    private $equivalentAmount;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var boolean $confirmed
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;
    
    
    public function __construct() {
        $this->additiveAmount = 0;
        $this->equivalentAmount = 0;
        $this->created = new \DateTime;
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
     * Set additiveAmount
     *
     * @param decimal $additiveAmount
     * @return Replenishment
     */
    public function setAdditiveAmount($additiveAmount)
    {
        $this->additiveAmount = $additiveAmount;
        return $this;
    }

    /**
     * Get additiveAmount
     *
     * @return decimal 
     */
    public function getAdditiveAmount()
    {
        return $this->additiveAmount;
    }

    /**
     * Set equivalentAmount
     *
     * @param decimal $equivalentAmount
     * @return Replenishment
     */
    public function setEquivalentAmount($equivalentAmount)
    {
        $this->equivalentAmount = $equivalentAmount;
        return $this;
    }

    /**
     * Get equivalentAmount
     *
     * @return decimal 
     */
    public function getEquivalentAmount()
    {
        return $this->equivalentAmount;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Replenishment
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Replenishment
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }
}