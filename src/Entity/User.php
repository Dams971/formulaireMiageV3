<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseDesParents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Baccalaureat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $premierAnnee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deuxiemeAnnee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diplomeObtenu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $candidaterAutresFormations;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $stageEntreprise;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $etreBts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactEntreprise;


    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom.' '.$this->prenom
            .' ('.$this->email.')';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function addRoles(string $roles): self
    {
        if (!in_array($roles, $this->roles)) {
            $this->roles[] = $roles;
        }

        return $this;
    }
    
    // countAllUser
    /**
     * @return int|mixed|string
     */
    public function countAllUser()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(u) FROM App\Entity\User u');
        $count = $query->getSingleScalarResult();
        return $count;
    }
    
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getdateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setdateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }



    private function getDoctrine()
    {
        return $this->doctrine;
    }

    public function getadresseDesParents(): ?string
    {
        return $this->adresseDesParents;
    }

    public function setadresseDesParents(?string $adresseDesParents): self
    {
        $this->adresseDesParents = $adresseDesParents;

        return $this;
    }

    public function getBaccalaureat(): ?string
    {
        return $this->Baccalaureat;
    }

    public function setBaccalaureat(?string $Baccalaureat): self
    {
        $this->Baccalaureat = $Baccalaureat;

        return $this;
    }

    public function getpremierAnnee(): ?string
    {
        return $this->premierAnnee;
    }

    public function setpremierAnnee(?string $premierAnnee): self
    {
        $this->premierAnnee = $premierAnnee;

        return $this;
    }

    public function getdeuxiemeAnnee(): ?string
    {
        return $this->deuxiemeAnnee;
    }

    public function setdeuxiemeAnnee(?string $deuxiemeAnnee): self
    {
        $this->deuxiemeAnnee = $deuxiemeAnnee;

        return $this;
    }

    public function getdiplomeObtenu(): ?string
    {
        return $this->diplomeObtenu;
    }

    public function setdiplomeObtenu(?string $diplomeObtenu): self
    {
        $this->diplomeObtenu = $diplomeObtenu;

        return $this;
    }

    public function isCandidaterAutresFormations(): ?bool
    {
        return $this->candidaterAutresFormations;
    }

    public function setCandidaterAutresFormations(?bool $candidaterAutresFormations): self
    {
        $this->candidaterAutresFormations = $candidaterAutresFormations;

        return $this;
    }

    public function isStageEntreprise(): ?bool
    {
        return $this->stageEntreprise;
    }

    public function setStageEntreprise(?bool $stageEntreprise): self
    {
        $this->stageEntreprise = $stageEntreprise;

        return $this;
    }

    public function isEtreBts(): ?bool
    {
        return $this->etreBts;
    }

    public function setEtreBts(?bool $etreBts): self
    {
        $this->etreBts = $etreBts;

        return $this;
    }

    public function getContactEntreprise(): ?string
    {
        return $this->contactEntreprise;
    }

    public function setContactEntreprise(?string $contactEntreprise): self
    {
        $this->contactEntreprise = $contactEntreprise;

        return $this;
    }

}
