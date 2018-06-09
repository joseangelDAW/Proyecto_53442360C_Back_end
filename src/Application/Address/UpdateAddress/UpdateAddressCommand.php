<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 17:51
 */

namespace App\Application\Address\UpdateAddress;


use Assert\Assertion;

class UpdateAddressCommand
{
    private $id;
    private $street;
    private $number;
    private $userId;
    private $floor;
    private $floorInformation;
    private $province;
    private $city;
    private $cp;

    /**
     * UpdateAddressCommand constructor.
     * @param int $id
     * @param string $street
     * @param string $number
     * @param string $floor
     * @param string $floorInformation
     * @param string $province
     * @param string $city
     * @param string $cp
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        int $id,
        string $street,
        string $number,
        string $floor,
        string $floorInformation,
        string $province,
        string $city,
        string $cp
    )
    {
        Assertion::notBlank($street);
        Assertion::string($street);
        Assertion::notBlank($number);
        Assertion::string($number);
        Assertion::notBlank($id);
        Assertion::numeric($id);
        Assertion::notBlank($floor);
        Assertion::string($floor);
        Assertion::notBlank($floorInformation);
        Assertion::string($floorInformation);
        Assertion::notBlank($province);
        Assertion::string($province);
        Assertion::notBlank($cp);
        Assertion::string($cp);

        $this->street = $street;
        $this->number = $number;
        $this->id = $id;
        $this->floor = $floor;
        $this->floorInformation = $floorInformation;
        $this->province = $province;
        $this->city = $city;
        $this->cp = $cp;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getFloor(): string
    {
        return $this->floor;
    }

    /**
     * @return string
     */
    public function getFloorInformation(): string
    {
        return $this->floorInformation;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCp(): string
    {
        return $this->cp;
    }



}