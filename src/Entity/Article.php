<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\AddToCart;
use App\Controller\GetCart;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={ "article:read" }
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "add_to_cart"={
 *              "method"="POST",
 *              "path"="/articles/{id}/add",
 *              "controller"=AddToCart::class,
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"article:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"article:read"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Groups({"article:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"article:read"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"article:read"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"article:read"})
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Order::class, mappedBy="articles")
     * @Groups({"article:read"})
     */
    private $orders;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="articles")
     * @ApiFilter(SearchFilter::class, properties={"categories.name": "exact"})
     * @Groups({"article:read"})
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleClassification::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"article:read"})
     */
    private $articleClassification;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addArticle($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addArticle($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeArticle($this);
        }

        return $this;
    }

    public function getArticleClassification(): ?ArticleClassification
    {
        return $this->articleClassification;
    }

    public function setArticleClassification(?ArticleClassification $articleClassification): self
    {
        $this->articleClassification = $articleClassification;

        return $this;
    }
}
