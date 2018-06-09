<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 2/05/18
 * Time: 19:49
 */

namespace App\Domain\Model\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function insertDefaultAdmin();

    /**
     * @param string $name
     * @param string $surname
     * @param \DateTime $birthDate
     * @param string $nickName
     * @param string $password
     * @param string $email
     * @return int
     */
    public function insertUser(
        string $name,
        string $surname,
        \DateTime $birthDate,
        string $nickName,
        string $password,
        string $email
    ): int;

    public function listUser(): array;

    /**
     * @param User $user
     * @param string $name
     * @param string $surname
     * @param string $nickname
     * @param string $email
     */
    public function updateUser(
        User $user,
        string $name,
        string $surname,
        string $nickname,
        string $email
    ): void;

    public function findUserById(int $id): ?User;

    public function findOneUserByNickname(string $nickname): ?User;

    public function findUserByKey(string $key, string $value): array;

    public function getValueByKey(User $user, string $key): ?string;

    public function persistAndFlush(User $user): void;
}