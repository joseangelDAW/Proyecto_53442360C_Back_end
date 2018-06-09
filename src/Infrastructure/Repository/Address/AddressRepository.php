<?php

namespace App\Infrastructure\Repository\Address;

use App\Domain\Model\Entity\Address\Address;
use App\Domain\Model\Entity\Address\AddressRepositoryInterface;
use App\Domain\Model\Entity\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class AddressRepository extends ServiceEntityRepository implements AddressRepositoryInterface
{
    /**
     * @param string $street
     * @param string $number
     * @param User $user
     * @param string $floor
     * @param string $floorInformation
     * @param string $province
     * @param string $city
     * @param string $cp
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertAddress(
        string $street,
        string $number,
        User $user,
        string $floor,
        string $floorInformation,
        string $province,
        string $city,
        string $cp
    ): void {
        $address = new Address();
        $address->setStreet($street);
        $address->setNumber($number);
        $address->setUser($user);
        $address->setFloor($floor);
        $address->setFloorInformation($floorInformation);
        $address->setProvince($province);
        $address->setCity($city);
        $address->setCp($cp);

        $this->persistAndFlush($address);
    }

    /**
     * @return array
     */
    public function listAddress(): array
    {
        return $this->findAll();
    }

    /**
     * @param Address $addressEntity
     * @param string $street
     * @param string $number
     * @param string $floor
     * @param string $floorInformation
     * @param string $province
     * @param string $city
     * @param string $cp
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAddress(
        Address $addressEntity,
        string $street,
        string $number,
        string $floor,
        string $floorInformation,
        string $province,
        string $city,
        string $cp
    ): void {
        $addressEntity->setStreet($street);
        $addressEntity->setNumber($number);
        $addressEntity->setFloor($floor);
        $addressEntity->setFloorInformation($floorInformation);
        $addressEntity->setProvince($province);
        $addressEntity->setCity($city);
        $addressEntity->setCp($cp);

        $this->persistAndFlush($addressEntity);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {
        return $this->findOneBy(["id" => $id]);
    }

    /**
     * @param int $userId
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findAddressByUserId(int $userId): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM address p
        WHERE p.user_id = :id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $userId]);

        return $stmt->fetchAll();
    }

    /**
     * @param string $key
     * @param string $value
     * @return array
     */
    public function findAddressByKey(string $key, string $value): array
    {
        return $this->findBy([$key => $value]);
    }

    /**
     * @param int $id
     * @return Address|null
     */
    public function findAddressById(int $id): ?Address
    {
        return $this->findOneBy(["id" => $id]);
    }

    /**
     * @param Address $address
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(Address $address): void
    {
        $this->getEntityManager()->persist($address);
        $this->getEntityManager()->flush();
    }
}