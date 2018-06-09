<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 5/05/18
 * Time: 10:26
 */

namespace App\Domain\Model\Entity\Pet;


use App\Domain\Model\Entity\User\User;

interface PetRepositoryInterface
{
    /**
     * @param string    $name
     * @param string    $typePet
     * @param string    $sex
     * @param string    $race
     * @param User      $user
     * @param \DateTime $birthDate
     */
    public function insertPet(
        string $name,
        string $typePet,
        string $sex,
        string $race,
        User $user,
        \DateTime $birthDate
    ): void;

    /**
     * @param int $id
     *
     * @return Pet|null
     */
    public function findPetById(int $id): ?Pet;

    /**
     * @param Pet       $pet
     * @param string    $name
     * @param string    $typePet
     * @param string    $sex
     * @param string    $race
     * @param \Datetime $birthDate
     */
    public function updatePet(
        Pet $pet,
        string $name,
        string $typePet,
        string $sex,
        string $race,
        \Datetime $birthDate
    ): void;

    public function listPet(): array;

    public function findPetByKey(string $key, string $value): array;

    public function findPetsByUserId(int $userId): array;

    public function findMatchedPet(string $typePet, string $sex, string $race, int $userId): array;

    public function setUrlPetImage(int $petId, string $uri);

    public function persistAndFlush(Pet $pet): void;

}