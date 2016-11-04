<?php

namespace resources\Entities;

/**
 * @Entity @Table(name="post")
 **/
class Post
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $content;

    /** @Column(type="datetime") **/
    protected $dateCreated;

    /**
     * @var User[]ArrayCollection User who did the post
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     */
    protected $user;

    /**
     * @var Ticket[]ArrayCollection Ticket
     * @ManyToOne(targetEntity="Ticket", inversedBy="tickets")
     * @JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    protected $ticket;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
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
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return Post
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreated = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreated;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Post
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     * @return Post
     */
    public function setTicket(Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
