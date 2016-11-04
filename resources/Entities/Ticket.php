<?php

namespace resources\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="ticket")
 **/
class Ticket
{
    const OPEN = "open";
    const CLOSE = 'close';
    const IN_PROGRESS = 'in_progress';

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $status;

    /**
     * @var User[]ArrayCollection User who did the post
     * @ManyToOne(targetEntity="User", inversedBy="tickets")
     */
    protected $user;

    /**
     * @var Admin[]ArrayCollection User who did the post
     * @ManyToOne(targetEntity="User", inversedBy="tickets")
     */
    protected $admin;

    /**
     * @OneToMany(targetEntity="Post", mappedBy="tickets", cascade={"persist", "remove"})
     */
    protected $posts;

    public function __construct()
    {
        $this->status = 'open';
        $this->admin = null;
        $this->posts = new ArrayCollection();
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
     * @return Ticket
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
     * Set status
     *
     * @param string $status
     * @return Ticket
     */
    public function setStatus($status)
    {
        if (!in_array($status, array(self::CLOSE, self::OPEN, self::IN_PROGRESS))) {
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set user
     *
     * @return Post
     */
    public function setUser($user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set admin
     *
     * @return Ticket
     */
    public function setAdmin($admin = null)
    {
        $this->admin = $admin;
        return $this;
    }
    /**
     * Get admin
     *
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Add posts
     *
     * @return User
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;
        return $this;
    }
    /**
     * Remove posts
     *
     */
    public function removePost($posts)
    {
        $this->posts->removeElement($posts);
    }
    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}