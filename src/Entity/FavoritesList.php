<?php

namespace App\Entity;

use App\Repository\FavoritesListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoritesListRepository::class)]
class FavoritesList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dateAdded;

    #[ORM\Column(type: 'string', length: 255)]
    private $movieTitle;

    #[ORM\Column(type: 'integer')]
    private $movieID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getMovieTitle(): ?string
    {
        return $this->movieTitle;
    }

    public function setMovieTitle(string $movieTitle): self
    {
        $this->movieTitle = $movieTitle;

        return $this;
    }

    public function getMovieID(): ?int
    {
        return $this->movieID;
    }

    public function setMovieID(int $movieID): self
    {
        $this->movieID = $movieID;

        return $this;
    }
}
