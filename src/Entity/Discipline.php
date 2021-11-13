<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping as ORM;

/**
 * Discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity
 */
class Discipline
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=65535, nullable=false)
     */
    private $shortDescription;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="sort_weight", type="boolean", nullable=true)
     */
    private $sortWeight;

    /**
     * @var string
     *
     * @ORM\Column(name="url_slug", type="string", length=50, nullable=false)
     */
    private $urlSlug;

    /**
     * @var int
     *
     * @ORM\Column(name="topic", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $topic = '0';

    /**
     * One discipline has many playlists.
     * @OneToMany(targetEntity="Playlist", mappedBy="discipline")
     * @OrderBy({"sortWeight" = "ASC"})
     */
    private $playlists;


    public function __construct()
    {
        $this->playlists = new ArrayCollection();
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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getSortWeight(): ?bool
    {
        return $this->sortWeight;
    }

    public function setSortWeight(?bool $sortWeight): self
    {
        $this->sortWeight = $sortWeight;

        return $this;
    }

    public function getUrlSlug(): ?string
    {
        return $this->urlSlug;
    }

    public function setUrlSlug(string $urlSlug): self
    {
        $this->urlSlug = $urlSlug;

        return $this;
    }

    public function getTopic(): ?int
    {
        return $this->topic;
    }

    public function setTopic(int $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylists($playlists): self
    {
        $this->playlists = $playlists;

        return $this;
    }
}
