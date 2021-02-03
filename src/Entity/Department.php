<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 * @ApiResource
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ArticleClassification::class, mappedBy="departement")
     */
    private $articleClassifications;

    public function __construct()
    {
        $this->articleClassifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ArticleClassification[]
     */
    public function getArticleClassifications(): Collection
    {
        return $this->articleClassifications;
    }

    public function addArticleClassification(ArticleClassification $articleClassification): self
    {
        if (!$this->articleClassifications->contains($articleClassification)) {
            $this->articleClassifications[] = $articleClassification;
            $articleClassification->setDepartement($this);
        }

        return $this;
    }

    public function removeArticleClassification(ArticleClassification $articleClassification): self
    {
        if ($this->articleClassifications->removeElement($articleClassification)) {
            // set the owning side to null (unless already changed)
            if ($articleClassification->getDepartement() === $this) {
                $articleClassification->setDepartement(null);
            }
        }

        return $this;
    }
}
