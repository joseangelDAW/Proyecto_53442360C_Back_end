<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 8:28
 */

namespace App\Application\Pet\UpdatePet;

use Assert\Assertion;
use DateTime;

class UpdatePetCommand
{
    private $name;
    private $typePet;
    private $sex;
    private $race;
    private $id;
    private $birthDate;

    /**
     * UpdatePetCommand constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $type
     * @param string $sex
     * @param string $race
     * @param string $birthDate
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        int $id,
        string $name,
        string $typePet,
        string $sex,
        string $race,
        string $birthDate
    ) {
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::notBlank($sex);
        Assertion::string($sex);
        Assertion::notBlank($typePet);
        Assertion::string($typePet);
        Assertion::notBlank($race);
        Assertion::string($race);
        Assertion::notBlank($id);
        Assertion::numeric($id);
        Assertion::notBlank($birthDate);
        Assertion::string($birthDate);

        $this->name = $name;
        $this->typePet = $typePet;
        $this->sex = $sex;
        $this->race = $race;
        $this->id = $id;
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
     * Get Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get TypePet
     *
     * @return string
     */
    public function getTypePet(): string
    {
        return $this->typePet;
    }

    /**
     * Get Sex
     *
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }


    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return DateTime::createFromFormat('Y-m-d', $this->birthDate);
    }
}