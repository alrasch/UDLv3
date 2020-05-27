<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
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
     * @var string|null
     *
     * @ORM\Column(name="short_description", type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @var int|null
     *
     * @ORM\Column(name="discipline_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $disciplineId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sort_weight", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $sortWeight;

    /**
     * Many articles can belong to one discipline.
     * @ORM\ManyToOne(targetEntity="Discipline", inversedBy="articles")
     */
    private $discipline;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param string|null $shortDescription
     */
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     */
    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return int|null
     */
    public function getDisciplineId(): ?int
    {
        return $this->disciplineId;
    }

    /**
     * @param int|null $disciplineId
     */
    public function setDisciplineId(?int $disciplineId): void
    {
        $this->disciplineId = $disciplineId;
    }

    /**
     * @return Discipline
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
     * @return int|null
     */
    public function getSortWeight(): ?int
    {
        return $this->sortWeight;
    }

    /**
     * @param int|null $sortWeight
     */
    public function setSortWeight(?int $sortWeight): void
    {
        $this->sortWeight = $sortWeight;
    }
}
