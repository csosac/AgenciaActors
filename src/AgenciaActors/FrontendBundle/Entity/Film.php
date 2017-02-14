<?php

namespace AgenciaActors\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="AgenciaActors\FrontendBundle\Repository\FilmRepository")
 */
class Film
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
     * @var int
     *
     * @ORM\Column(name="idFilm", type="integer", unique=true)
     */
    private $idFilm;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=70, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="film")
     * @ORM\JoinColumn(name="directorId", referencedColumnName="id")
     */
    protected $director;


    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="film")
     */
    protected $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


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
     * Set idFilm
     *
     * @param integer $idFilm
     *
     * @return Film
     */
    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;

        return $this;
    }

    /**
     * Get idFilm
     *
     * @return int
     */
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Film
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
     * Set description
     *
     * @param string $description
     *
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Film
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set startDate
     *
     * @param date $startDate
     *
     * @return Film
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     *
     * @return Film
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }


    /**
     * @param Director|null $director
     * @return $this
     */
    public function setDirector(Director $director = null)
    {
        $this->director = $director;
 
        return $this;
    }
 
    /**
     * @return director
     */
    public function getDirector()
    {
        return $this->director;
    }
 
}

