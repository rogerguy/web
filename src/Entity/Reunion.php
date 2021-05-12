<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="reunion")
 */
class Reunion
{
    public function __construct()
    {
        $this->created = new \DateTime();
    }

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(name="membrepresent")
     */   
    private $membrepresent;

      /**
     * @ORM\Column(name="membreabsent")
     */   
    private $membreabsent;


   /**
     * @var string
     *
     * @ORM\Column(name="contenue", type="text")
     */   
    private $contenu;


    /**
     
     * @var \DateTime $created
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getMembrepresent(): ?string
    {
        return $this->membrepresent;
    }

    public function setMembrepresent(string $membrepresent): self
    {
        $this->membrepresent = $membrepresent;

        return $this;
    }

    public function getMembreabsent(): ?string
    {
        return $this->membreabsent;
    }

    public function setMembreabsent(string $membreabsent): self
    {
        $this->membreabsent = $membreabsent;

        return $this;
    }
}