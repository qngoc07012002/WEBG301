<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SongRepository::class)
 */
class Song
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
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Artist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Song_URL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->Artist;
    }

    public function setArtist(?Artist $Artist): self
    {
        $this->Artist = $Artist;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getSongURL(): ?string
    {
        return $this->Song_URL;
    }

    public function setSongURL(string $Song_URL): self
    {
        $this->Song_URL = $Song_URL;

        return $this;
    }
}
