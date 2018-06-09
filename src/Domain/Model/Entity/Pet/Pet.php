<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/04/18
 * Time: 21:47
 */

namespace App\Domain\Model\Entity\Pet;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\Pet\PetRepository")
 */
class Pet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\User\User", inversedBy="pets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $typePet;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $race;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $typePet
     */
    public function setTypePet($typePet): void
    {
        $this->typePet = $typePet;
    }

    /**
     * @return mixed
     */
    public function getTypePet()
    {
        return $this->typePet;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race): void
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}

