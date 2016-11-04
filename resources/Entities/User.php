<?php

namespace resources\Entities;

/**
 * @Entity @Table(name="users")
 */
class User
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $login;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $password;

    /**
     * @var posts[]ArrayCollection post of this user
     * @OneToMany(targetEntity="Post", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $posts;

    /**
     * @var posts[]ArrayCollection ticket of this user
     * @OneToMany(targetEntity="Ticket", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $tickets;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $role;

    public function __construct()
    {
        $this->role = 'user';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function checkPassword($password)
    {
        if ($this->password == hash('ripemd160', $password))
            return true;

        return false;
    }

    public function setPassword($passOne, $passTwo)
    {
        if ($passOne == $passTwo){
            $this->password = hash('ripemd160', $passOne);
        }else{
            echo 'les mdp ne correspond pas';
        }
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
    public function removePost(Post $posts)
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

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}
