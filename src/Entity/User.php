<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]

// #[ApiResource(
//     collectionOperations: ['get', 'post'],
//     itemOperations: ['get', 'delete']
// )]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 100)]
    #[Assert\Regex(pattern: '/^[A-Za-z\s]*$/', message: 'Only letters and spaces are allowed')]
       private ?string $name = null;

       #[ORM\Column(type: 'string')]
       #[Assert\NotBlank]
       #[Assert\Choice(choices: ['ROLE_USER', 'ROLE_COMPANY_ADMIN', 'ROLE_SUPER_ADMIN'])]
       private string $role;

        #[ORM\ManyToOne(targetEntity: Company::class)]
        #[ORM\JoinColumn(nullable: true)]
        private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }


    // public function getCompany(): ?string
    // {
    //     return $this->id;
    // }

    // public function setCompany(string $company): static
    // {
    //     $this->company = $company;

    //     return $this;
    // }
}
