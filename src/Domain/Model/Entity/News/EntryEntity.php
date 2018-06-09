<?php

namespace App\Domain\Model\Entity\News;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\News\EntryEntityRepository")
 */
class EntryEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEntry;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * Get Image
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set Image
     *
     * @param mixed $image
     *
     * @return EntryEntity
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateEntry()
    {
        return $this->dateEntry;
    }

    /**
     * @param mixed $dateEntry
     */
    public function setDateEntry($dateEntry): void
    {
        $this->dateEntry = $dateEntry;
    }
}
