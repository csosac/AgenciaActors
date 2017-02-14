<?php

namespace AgenciaActors\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AgenciaActors\FrontendBundle\Repository\RoleRepository")
 */
class Role
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
     *
     * @ORM\ManyToOne(targetEntity="Actor", inversedBy="role")
     * @ORM\JoinColumn(name="actorId", referencedColumnName="id")
     */
    protected $actor;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="role")
     * @ORM\JoinColumn(name="filmId", referencedColumnName="id")
     */
    protected $film;


    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100, nullable=true)
     */
    private $role;


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
     * Set role
     *
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

       /**
     * @param Actor|null $actor
     * @return $this
     */
    public function setActor(Actor $actor = null)
    {
        $this->actor = $actor;
 
        return $this;
    }
 
    /**
     * @return actor
     */
    public function getActor()
    {
        return $this->actor;
    }
 
        /**
     * @param Film|null $pelicula
     * @return $this
     */
    public function setFilm(Film $pelicula = null)
    {
        $this->film = $pelicula;
 
        return $this;
    }
 
    /**
     * @return pelicula
     */
    public function getFilm()
    {
        return $this->film;
    }
 
}

