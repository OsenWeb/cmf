<?php

namespace BW\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="menu_items")
 * @ORM\Entity(repositoryClass="BW\MenuBundle\Entity\ItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255)
     */
    private $href;

    /**
     * @var boolean
     *
     * @ORM\Column(name="in_new", type="boolean")
     */
    private $inNew;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordering", type="integer")
     */
    private $ordering;
    

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="items")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     */
    private $menu;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="parent")
     */
    private $children;

    
    /**
     * Текущий уровень вложенности пункта меню
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return integer
     */
    public function generateLevel() {
        $this->level = 0;
        $parent = $this->getParent();
        
        while ($parent) {
            $this->level++;
            $parent = $parent->getParent();
        }
        
        return $this;
    }
    
    /**
     * Generate nesting
     * 
     * ORM\PrePersist
     * ORM\PreUpdate
     * param string $nesting
     * return Item
     */
//    public function generateNesting()
//    {
//        $this->nesting = '0';
//        
//        if ($this->getId()) {
//            $this->nesting = $this->getId();
//            $parent = $this->getParent();
//
//            while ($parent) {
//                $this->nesting = $parent->getId() .'.'. $this->nesting;
//                $parent = $parent->getParent();
//            }
//        }
//    
//        return $this;
//    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->inNew        = FALSE;
        $this->level        = 0;
        $this->ordering     = 0;
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
     * Set name
     *
     * @param string $name
     * @return Item
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
     * Set title
     *
     * @param string $title
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set inNew
     *
     * @param boolean $inNew
     * @return Item
     */
    public function setInNew($inNew)
    {
        $this->inNew = $inNew;
    
        return $this;
    }

    /**
     * Get inNew
     *
     * @return boolean 
     */
    public function getInNew()
    {
        return $this->inNew;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Item
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     * @return Item
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    
        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer 
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set menu
     *
     * @param \BW\MenuBundle\Entity\Menu $menu
     * @return Item
     */
    public function setMenu(\BW\MenuBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return \BW\MenuBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set parent
     *
     * @param \BW\MenuBundle\Entity\Item $parent
     * @return Item
     */
    public function setParent(\BW\MenuBundle\Entity\Item $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \BW\MenuBundle\Entity\Item 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \BW\MenuBundle\Entity\Item $children
     * @return Item
     */
    public function addChildren(\BW\MenuBundle\Entity\Item $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \BW\MenuBundle\Entity\Item $children
     */
    public function removeChildren(\BW\MenuBundle\Entity\Item $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set href
     *
     * @param string $href
     * @return Item
     */
    public function setHref($href)
    {
        $this->href = $href;
    
        return $this;
    }

    /**
     * Get href
     *
     * @return string 
     */
    public function getHref()
    {
        return $this->href;
    }
}