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
     * @var string
     *
     * @ORM\Column(name="nifActor", type="string", length=20, nullable=true)
     */
    private $nifActor;

    /**
     *
     * @ORM\ManyToOne(targetEntity="film", inversedBy="role")
     * @ORM\JoinColumn(name="idFilm", referencedColumnName="id")
     */
    protected $idFilm;


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
     * Set nifActor
     *
     * @param string $nifActor
     *
     * @return Role
     */
    public function setNifActor($nifActor)
    {
        $this->nifActor = $nifActor;

        return $this;
    }

    /**
     * Get nifActor
     *
     * @return string
     */
    public function getNifActor()
    {
        return $this->nifActor;
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
}
