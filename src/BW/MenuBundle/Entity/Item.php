<?php

namespace BW\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use BW\MainBundle\Entity\BWEntity;

/**
 * Item
 *
 * @ORM\Table(name="menu_items")
 * @ORM\Entity(repositoryClass="BW\MenuBundle\Entity\ItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Item extends BWEntity
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
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=255)
     */
    private $class;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blank", type="boolean")
     */
    private $blank;

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
     * @ORM\ManyToOne(targetEntity="\BW\MenuBundle\Entity\Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="\BW\LocalizationBundle\Entity\Lang")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;
    
    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="parent")
     */
    private $children;
    
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
     * @ORM\Column(name="level", type="integer")
     */
    private $level;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="lft", type="integer")
     */
    private $left;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="rgt", type="integer")
     */
    private $right;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="\BW\RouterBundle\Entity\Route")
     * @ORM\JoinColumn(name="route_id", referencedColumnName="id")
     */
    private $route;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

    protected $temp;

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * get rid of the __DIR__ so it doesn't screw up
     * when displaying uploaded doc/image in the view.
     *
     * @return string 'uploads/path/to/subfolder'
     */
    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/menu/items';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    
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
    
    
    public function __toString() {
        
        return str_repeat('- ', $this->getLevel()). $this->getName();
    }

    /**
     * Set default values
     * 
     * @ORM\PrePersist
     * @param array $values
     * @return Item
     */
    public function setDefaultValues(\Doctrine\ORM\Event\LifecycleEventArgs $args) {
        $values = array(
            'title' => '',
            'href' => '',
            'class' => '',
        );
        
        $item = $args->getEntity();
        $class = __CLASS__;
        if ($item instanceof $class) {
            foreach ($values as $field => $value) {
                $getter = 'get'. ucfirst($field);
                if (method_exists($this, $getter)) {
                    if ($this->$getter() === NULL) {
                        $setter = 'set'. ucfirst($field);
                        if (method_exists($this, $setter)) {
                            $this->$setter($value);
                        }
                    }
                }
            }
        }
        
        return $this;
    }
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blank        = FALSE;
        $this->ordering     = 0;
        $this->level        = 0;
        $this->left         = 0;
        $this->right        = 0;
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
     * Set blank
     *
     * @param boolean $blank
     * @return Item
     */
    public function setBlank($blank)
    {
        $this->blank = $blank;
    
        return $this;
    }

    /**
     * Get blank
     *
     * @return boolean 
     */
    public function getBlank()
    {
        return $this->blank;
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

    /**
     * Set class
     *
     * @param string $class
     * @return Item
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set lang
     *
     * @param \BW\LocalizationBundle\Entity\Lang $lang
     * @return Item
     */
    public function setLang(\BW\LocalizationBundle\Entity\Lang $lang = null)
    {
        $this->lang = $lang;
    
        return $this;
    }

    /**
     * Get lang
     *
     * @return \BW\LocalizationBundle\Entity\Lang 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set type
     *
     * @param \BW\MenuBundle\Entity\Type $type
     * @return Item
     */
    public function setType(\BW\MenuBundle\Entity\Type $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \BW\MenuBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set left
     *
     * @param integer $left
     * @return Item
     */
    public function setLeft($left)
    {
        $this->left = $left;
        return $this;
    }

    /**
     * Get left
     *
     * @return integer 
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set right
     *
     * @param integer $right
     * @return Item
     */
    public function setRight($right)
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Get right
     *
     * @return integer 
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param \BW\RouterBundle\Entity\Route $route
     * @return $this
     */
    public function setRoute(\BW\RouterBundle\Entity\Route $route = null)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Item
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add children
     *
     * @param \BW\MenuBundle\Entity\Item $children
     * @return Item
     */
    public function addChild(\BW\MenuBundle\Entity\Item $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \BW\MenuBundle\Entity\Item $children
     */
    public function removeChild(\BW\MenuBundle\Entity\Item $children)
    {
        $this->children->removeElement($children);
    }
}
