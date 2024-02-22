<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'node')]
#[ORM\Index(name: 'node_changed', columns: ['changed'])]
#[ORM\Index(name: 'uid', columns: ['uid'])]
#[ORM\Index(name: 'node_frontpage', columns: ['promote', 'status', 'sticky', 'created'])]
#[ORM\Index(name: 'translate', columns: ['translate'])]
#[ORM\Index(name: 'node_status_type', columns: ['status', 'type', 'nid'])]
#[ORM\Index(name: 'node_title_type', columns: ['title', 'type'])]
#[ORM\Index(name: 'node_type', columns: ['type'])]
#[ORM\Index(name: 'node_created', columns: ['created'])]
#[ORM\Index(name: 'tnid', columns: ['tnid'])]
#[ORM\Index(name: 'language', columns: ['language'])]
#[ORM\UniqueConstraint(name: 'vid', columns: ['vid'])]
#[ORM\Entity]
class Node
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'nid', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private $nid;

    /**
     * @var int|null
     */
    #[ORM\Column(name: 'vid', type: 'integer', nullable: true)]
    private $vid;

    /**
     * @var string
     */
    #[ORM\Column(name: 'type', type: 'string', length: 32, nullable: false)]
    private $type;

    /**
     * @var string
     */
    #[ORM\Column(name: 'language', type: 'string', length: 12, nullable: false)]
    private $language;

    /**
     * @var string
     */
    #[ORM\Column(name: 'title', type: 'string', length: 255, nullable: false)]
    private $title;

    /**
     * @var int
     */
    #[ORM\Column(name: 'uid', type: 'integer', nullable: false)]
    private $uid;

    /**
     * @var int
     */
    #[ORM\Column(name: 'status', type: 'integer', nullable: false)]
    private $status;

    /**
     * @var int
     */
    #[ORM\Column(name: 'created', type: 'integer', nullable: false)]
    private $created;

    /**
     * @var int
     */
    #[ORM\Column(name: 'changed', type: 'integer', nullable: false)]
    private $changed;

    /**
     * @var int
     */
    #[ORM\Column(name: 'comment', type: 'integer', nullable: false)]
    private $comment;

    /**
     * @var int
     */
    #[ORM\Column(name: 'promote', type: 'integer', nullable: false)]
    private $promote;

    /**
     * @var int
     */
    #[ORM\Column(name: 'sticky', type: 'integer', nullable: false)]
    private $sticky;

    /**
     * @var int
     */
    #[ORM\Column(name: 'tnid', type: 'integer', nullable: false)]
    private $tnid;

    /**
     * @var int
     */
    #[ORM\Column(name: 'translate', type: 'integer', nullable: false)]
    private $translate;

    public function getNid(): ?int
    {
        return $this->nid;
    }

    public function getVid(): ?int
    {
        return $this->vid;
    }

    public function setVid(?int $vid): self
    {
        $this->vid = $vid;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreated(): ?int
    {
        return $this->created;
    }

    public function setCreated(int $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getChanged(): ?int
    {
        return $this->changed;
    }

    public function setChanged(int $changed): self
    {
        $this->changed = $changed;

        return $this;
    }

    public function getComment(): ?int
    {
        return $this->comment;
    }

    public function setComment(int $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPromote(): ?int
    {
        return $this->promote;
    }

    public function setPromote(int $promote): self
    {
        $this->promote = $promote;

        return $this;
    }

    public function getSticky(): ?int
    {
        return $this->sticky;
    }

    public function setSticky(int $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function getTnid(): ?int
    {
        return $this->tnid;
    }

    public function setTnid(int $tnid): self
    {
        $this->tnid = $tnid;

        return $this;
    }

    public function getTranslate(): ?int
    {
        return $this->translate;
    }

    public function setTranslate(int $translate): self
    {
        $this->translate = $translate;

        return $this;
    }


}
