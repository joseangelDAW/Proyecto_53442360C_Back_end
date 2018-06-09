<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/04/18
 * Time: 21:51
 */

namespace App\Infrastructure\Repository\Pet;

use App\Domain\Model\Entity\Pet\Pet;
use App\Domain\Model\Entity\Pet\PetRepositoryInterface;
use App\Domain\Model\Entity\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class PetRepository extends ServiceEntityRepository implements PetRepositoryInterface
{
    /**
     * @param string    $name
     * @param string    $typePet
     * @param string    $sex
     * @param string    $race
     * @param User      $user
     * @param \DateTime $birthDate
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertPet(
        string $name,
        string $typePet,
        string $sex,
        string $race,
        User $user,
        \DateTime $birthDate
    ): void {
        $pet = new Pet();
        $pet->setName($name);
        $pet->setTypePet($typePet);
        $pet->setSex($sex);
        $pet->setRace($race);
        $pet->setUser($user);
        $pet->setBirthDate($birthDate);

        $this->persistAndFlush($pet);
    }

    /**
     * @return array
     */
    public function listPet(): array
    {
        return $this->findAll();
    }

    /**
     * @param Pet       $pet
     * @param string    $name
     * @param string    $typePet
     * @param string    $sex
     * @param string    $race
     * @param \Datetime $birthDate
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updatePet(
        Pet $pet,
        string $name,
        string $typePet,
        string $sex,
        string $race,
        \Datetime $birthDate
    ): void {
        $pet->setName($name);
        $pet->setTypePet($typePet);
        $pet->setSex($sex);
        $pet->setRace($race);
        $pet->setBirthDate($birthDate);
        $this->persistAndFlush($pet);
    }

    /**
     * @param int $id
     *
     * @return Pet|null
     */
    public function findPetById(int $id): ?Pet
    {
        return $this->findOneBy(["id" => $id]);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    public function findPetByKey(string $key, string $value): array
    {
        return $this->findBy([$key => $value]);
    }

    /**
     * @param $userId
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findPetsByUserId(int $userId): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM pet p
        WHERE p.user_id = :id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $userId]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /**
     * @param string $typePet
     * @param string $sex
     * @param string $race
     * @param int $userId
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findMatchedPet(string $typePet, string $sex, string $race, int $userId): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select u.email, p.name, p.image from user u, pet p 
                    where u.id=p.user_id and p.user_id!=:user_id and p.type_pet=:typePet
                    and p.sex=:sex';

        $stmt = $conn->prepare($sql);
        $stmt->execute(
            [
                'typePet' => $typePet,
                'sex' => $sex,
                'user_id' => $userId
            ]
        );

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /**
     * @param int $petId
     * @param string $uri
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setUrlPetImage(int $petId, string $uri)
    {
        $petEntity = $this->findPetById($petId);
        $petEntity->setImage($uri);

        $this->persistAndFlush($petEntity);
    }

    /**
     * @param Pet $pet
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Pet $pet): void
    {
        $this->getEntityManager()->persist($pet);
        $this->getEntityManager()->flush();
    }

}