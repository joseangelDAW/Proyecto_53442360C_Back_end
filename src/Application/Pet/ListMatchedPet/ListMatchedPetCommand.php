<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29/05/18
 * Time: 19:21
 */

namespace App\Application\Pet\ListMatchedPet;


use Assert\Assertion;

class ListMatchedPetCommand
{
    private $typePet;
    private $race;
    private $sex;
    private $userId;

    /**
     * ListMatchedPetCommand constructor.
     * @param string $typePet
     * @param string $sex
     * @param string $race
     * @param int $userId
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(string $typePet, string $sex, string $race, int $userId)
    {
        Assertion::notBlank($typePet);
        Assertion::string($typePet);
        Assertion::notBlank($sex);
        Assertion::string($sex);
        Assertion::notBlank($race);
        Assertion::string($race);
        Assertion::notBlank($userId);
        Assertion::numeric($userId);

        $this->typePet = $typePet;
        $this->sex = $sex;
        $this->race = $race;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTypePet(): string
    {
        return $this->typePet;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

}