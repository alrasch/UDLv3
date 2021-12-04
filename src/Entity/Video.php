<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url_slug", type="string", length=255, nullable=false)
     */
    private $urlSlug;

    /**
     * @var int
     *
     * @ORM\Column(name="playlist_id", type="integer", nullable=false)
     */
    private $playlistId;

    /**
     * @var int
     *
     * @ORM\Column(name="sort_weight", type="integer", nullable=false)
     */
    private $sortWeight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="youtube_url", type="string", length=255, nullable=true)
     */
    private $youtubeUrl;

    /**
     * Many videos can belong to one playlist.
     * @ManyToOne(targetEntity="Playlist", inversedBy="videos")
     */
    private $playlist;

    /**
     * @return Playlist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param mixed $playlist
     */
    public function setPlaylist($playlist): void
    {
        $this->playlist = $playlist;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPlaylistId(): ?int
    {
        return $this->playlistId;
    }

    public function setPlaylistId(int $playlistId): self
    {
        $this->playlistId = $playlistId;

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

    public function getYoutubeUrl(): ?string
    {
        return $this->youtubeUrl;
    }

    public function setYoutubeUrl(?string $youtubeUrl): self
    {
        $this->youtubeUrl = $youtubeUrl;

        return $this;
    }
}
