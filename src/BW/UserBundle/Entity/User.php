<?php

namespace BW\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="BW\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=60, nullable=true, unique=true)
     */
    private $email;

    /**
     * Активен пользователь или нет
     * 
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $active;

    /**
     * Подтвержден e-mail пользователя или нет
     * 
     * @ORM\Column(name="is_confirm", type="boolean")
     */
    private $confirm;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    
    /**
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;
    
    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;
    
    /**
     * @ORM\Column(name="hash", type="string", length=255)
     */
    private $hash;
    
    /**
     * @ORM\Column(name="facebook_id", type="string", length=32, nullable=true, unique=true)
     */
    private $facebookId;
    
    /**
     * @ORM\Column(name="google_id", type="string", length=32, nullable=true, unique=true)
     */
    private $googleId;
    
    /**
     * @ORM\Column(name="vkontakte_id", type="string", length=32, nullable=true, unique=true)
     */
    private $vkontakteId;
    
    /**
     * @ORM\OneToMany(targetEntity="\BW\MailingBundle\Entity\Mailing", mappedBy="user")
     */
    private $mailing;
    
    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     */
    private $profile;
    
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }

    public function isConfirmed()
    {
        return $this->confirm;
    }

    /**
     * Генерирует пароль пользователя из 13 символов, уникальный для каждого нового вызова метода
     * 
     * @return string
     */
    public function generateRandomPassword()
    {
        $this->password = uniqid(NULL, FALSE);
        
        return $this->password;
    }

    /**
     * Генерирует hash для ссылки автоматической активации аккаунта
     * 
     * @return string
     */
    public function generateRandomHash()
    {
        $this->hash = md5(uniqid(NULL, TRUE));
        
        return $this->hash;
    }

    /**
     * Generate date of update
     * 
     * @ORM\PreUpdate
     * @return \BW\UserBundle\Entity\User
     */
    public function generateUpdatedDate() {
        $this->updated = new \DateTime;
        
        return $this;
    }
    
    
    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->mailing = new ArrayCollection();
        
        $this->active           = FALSE;
        $this->confirm          = FALSE;
        $this->salt             = md5(uniqid(NULL, TRUE));
        $this->hash             = md5(uniqid(NULL, TRUE));
        $this->created          = new \DateTime;
        $this->updated          = new \DateTime;
    }

    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }
    
    public function getRolesCollection()
    {
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Is active
     *
     * @return boolean 
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set confirm
     *
     * @param boolean $confirm
     * @return User
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;
    
        return $this;
    }

    /**
     * Get confirm
     *
     * @return boolean 
     */
    public function getConfirm()
    {
        return $this->confirm;
    }
    
    /**
     * Is confirm
     *
     * @return boolean 
     */
    public function isConfirm()
    {
        return $this->confirm;
    }
    
    /**
     * Add roles
     *
     * @param \BW\UserBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\BW\UserBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \BW\UserBundle\Entity\Role $roles
     */
    public function removeRole(\BW\UserBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return User
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    
        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set facebookId
     *
     * @param mixed $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set googleId
     *
     * @param mixed $googleId
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string 
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set vkontakteId
     *
     * @param string $vkontakteId
     * @return User
     */
    public function setVkontakteId($vkontakteId)
    {
        $this->vkontakteId = $vkontakteId;

        return $this;
    }

    /**
     * Get vkontakteId
     *
     * @return string 
     */
    public function getVkontakteId()
    {
        return $this->vkontakteId;
    }

    /**
     * Add mailing
     *
     * @param BW\MailingBundle\Entity\Mailing $mailing
     * @return User
     */
    public function addMailing(\BW\MailingBundle\Entity\Mailing $mailing)
    {
        $this->mailing[] = $mailing;
        return $this;
    }

    /**
     * Remove mailing
     *
     * @param BW\MailingBundle\Entity\Mailing $mailing
     */
    public function removeMailing(\BW\MailingBundle\Entity\Mailing $mailing)
    {
        $this->mailing->removeElement($mailing);
    }

    /**
     * Get mailing
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMailing()
    {
        return $this->mailing;
    }

    /**
     * Set profile
     *
     * @param BW\UserBundle\Entity\Profile $profile
     * @return User
     */
    public function setProfile(\BW\UserBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * Get profile
     *
     * @return BW\UserBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}