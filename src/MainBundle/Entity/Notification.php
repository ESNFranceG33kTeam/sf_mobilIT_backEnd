<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity
 * @ORM\Table(name="notifications")
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\NotificationRepository")
*/
class Notification
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="text")
     * @Expose
     */
    private $title;

    /**
     * @ORM\Column(name="content", type="text")
     * @Expose
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="section", inversedBy="notification")
     * @ORM\JoinColumn(name="section", referencedColumnName="codeSection")
     * @Expose
     */
    protected $section;

    /**
     * @ORM\Column(name="sentAt", type="datetime")
     * @Expose
     */
    protected $sentAt;

    /**
     * @ORM\ManyToOne(targetEntity="user", inversedBy="notifications")
     * @ORM\JoinColumn(name="sentBy", referencedColumnName="id")
     */
    protected $sentBy;

    public function __construct()
    {
        $this->sentAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param Section $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * @return mixed
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param mixed $sentAt
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    /**
     * @return User
     */
    public function getSentBy()
    {
        return $this->sentBy;
    }

    /**
     * @param User $sentBy
     */
    public function setSentBy(User $sentBy)
    {
        $this->sentBy = $sentBy;
    }
}