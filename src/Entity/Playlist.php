<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity
 */
class Playlist
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
     * @var int|null
     *
     * @ORM\Column(name="discipline_id", type="integer", nullable=true)
     */
    private $disciplineId;

    /**
     * @var int
     *
     * @ORM\Column(name="sort_weight", type="integer", nullable=false)
     */
    private $sortWeight;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="short_description", type="text", length=65535, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="url_slug", type="string", length=100, nullable=false)
     */
    private $urlSlug;

    /**
     * Many playlists can belong to one discipline.
     * @ManyToOne(targetEntity="Discipline", inversedBy="playlists")
     */
    private $discipline;

    /**
     * One playlist has many videos.
     * @OneToMany(targetEntity="Video", mappedBy="playlist")
     * @OrderBy({"sortWeight" = "ASC"})
     */
    private $videos;

    /**
     * @return mixed
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param mixed $discipline
     */
    public function setDiscipline($discipline): void
    {
        $this->discipline = $discipline;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos): void
    {
        $this->videos = $videos;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisciplineId(): ?int
    {
        return $this->disciplineId;
    }

    public function setDisciplineId(?int $disciplineId): self
    {
        $this->disciplineId = $disciplineId;

        return $this;
    }

    public function getSortWeight(): ?int
    {
        return $this->sortWeight;
    }

    public function setSortWeight(int $sortWeight): self
    {
        $this->sortWeight = $sortWeight;

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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

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
}
