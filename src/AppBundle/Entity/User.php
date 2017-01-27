<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ExclusionPolicy("all")
 */
class User
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
     * @ORM\Column(name="name", type="string", length=32)
     * @Assert\NotNull()
     * @Expose
     */
    protected $name;

    /**
     * @var UserDetail
     *
     * @ORM\ManyToOne(targetEntity="UserDetail")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $userDetails;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * @return UserDetail
     */
    public function getUserDetails()
    {
        return $this->userDetails;
    }

    /**
     * @param UserDetail $userDetails
     * @return $this
     */
    public function setUserDetails(UserDetail $userDetails)
    {
        $this->userDetails = $userDetails;

        return $this;
    }

}
