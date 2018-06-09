<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\Model\Entity\User\User;
use App\Domain\Model\Entity\User\UserConst;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $surname
     * @param \DateTime $birthDate
     * @param string $nickName
     * @param string $email
     * @param string $password
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertUser(
        string $name,
        string $surname,
        \DateTime $birthDate,
        string $nickName,
        string $email,
        string $password
    ): int {
        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setBirthDate($birthDate);
        $user->setNickname($nickName);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $user->setRole("user");

        $this->persistAndFlush($user);

        return $user->getId();
    }

    public function listUser(): array
    {
        return $this->findAll();
    }

    /**
     * @param User $user
     * @param string $name
     * @param string $surname
     * @param string $nickname
     * @param string $email
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateUser(
        User $user,
        string $name,
        string $surname,
        string $nickname,
        string $email
    ): void {
        $user->setName($name);
        $user->setSurname($surname);
        $user->setNickname($nickname);
        $user->setEmail($email);

        $this->persistAndFlush($user);
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
     * @param string $key
     * @param string $value
     * @return array
     */
    public function findUserByKey(string $key, string $value): array
    {
        return $this->findBy([$key => $value]);
    }

    /**
     * @param string $nickname
     * @return User|null
     */
    public function findOneUserByNickname(string $nickname): ?User
    {
        return $this->findOneBy([UserConst::NICKNAME => $nickname]);
    }

    /**
     * @param User $user
     * @param string $key
     * @return null|string
     */
    public function getValueByKey(User $user, string $key): ?string
    {
        if ($key == UserConst::EMAIL) {
            return $user->getEmail();
        }
        if ($key == UserConst::NICKNAME) {
            return $user->getNickname();
        }
        if ($key == UserConst::PASSWORD) {
            return $user->getPassword();
        }
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}
