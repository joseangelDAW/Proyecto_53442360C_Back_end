<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/04/18
 * Time: 20:27
 */

namespace App\Domain\Model\Entity\Address;


use App\Domain\Model\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\Address\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Model\Entity\User\User", inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=40, nullable=false)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $floorInformation;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $city;

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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return User
     */
    public function getUser(): User
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
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function getFloorInformation()
    {
        return $this->floorInformation;
    }

    /**
     * @param mixed $floorInformation
     */
    public function setFloorInformation($floorInformation): void
    {
        $this->floorInformation = $floorInformation;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $province
     */
    public function setProvince($province): void
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }


}