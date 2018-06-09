<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/05/18
 * Time: 19:35
 */

namespace App\Application\Pet\InsertPet;

use Assert\Assertion;
use DateTime;

class InsertPetCommand
{
    private $name;
    private $race;
    private $userId;
    private $birthDate;
    private $sex;
    private $typePet;

    /**
     * InsertPetCommand constructor.
     *
     * @param string $name
     * @param string $typePet
     * @param string $sex
     * @param string $race
     * @param int    $userId
     * @param string $birthDate
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        string $name,
        string $typePet,
        string $sex,
        string $race,
        int $userId,
        string $birthDate
    ) {
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::notBlank($race);
        Assertion::string($race);
        Assertion::notBlank($sex);
        Assertion::string($sex);
        Assertion::notBlank($typePet);
        Assertion::string($typePet);
        Assertion::notBlank($userId);
        Assertion::numeric($userId);
        Assertion::notBlank($birthDate);
        Assertion::string($birthDate);

        $this->name = $name;
        $this->typePet = $typePet;
        $this->sex = $sex;
        $this->race = $race;
        $this->userId = $userId;
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return DateTime::createFromFormat('Y-m-d', $this->birthDate);
    }

    /**
     * Get Sex
     *
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Get Type
     *
     * @return mixed
     */
    public function getTypePet()
    {
        return $this->typePet;
    }



}