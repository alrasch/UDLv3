<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeDescription
 *
 * @ORM\Table(name="node_description")
 * @ORM\Entity
 */
class NodeDescription
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
     * @var int
     *
     * @ORM\Column(name="node", type="integer", nullable=false)
     */
    private $node;

    /**
     * @var string|null
     *
     * @ORM\Column(name="full_description", type="text", length=65535, nullable=true)
     */
    private $fullDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNode(): ?int
    {
        return $this->node;
    }

    public function setNode(int $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(?string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }


}
