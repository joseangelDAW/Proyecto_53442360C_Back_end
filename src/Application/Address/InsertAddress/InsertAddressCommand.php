<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 6/05/18
 * Time: 18:51
 */

namespace App\Application\Address\InsertAddress;


use Assert\Assert;
use Assert\Assertion;

class InsertAddressCommand
{
    private $street;
    private $number;
    private $userId;
    private $floor;
    private $floorInformation;
    private $province;
    private $city;
    private $cp;

    /**
     * InsertAddressCommand constructor.
     * @param string $street
     * @param string $number
     * @param int $userId
     * @param string $floor
     * @param string $floorInformation
     * @param string $province
     * @param string $city
     * @param string $cp
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        string $street,
        string $number,
        int $userId,
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
        Assertion::notBlank($userId);
        Assertion::numeric($userId);
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
        $this->userId = $userId;
        $this->floor = $floor;
        $this->floorInformation = $floorInformation;
        $this->province = $province;
        $this->city = $city;
        $this->cp = $cp;
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
     * @return int
     */
    public function getUserId(): int
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