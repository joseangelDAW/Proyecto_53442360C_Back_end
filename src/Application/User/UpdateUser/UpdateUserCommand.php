<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 11:29
 */

namespace App\Application\User\UpdateUser;


use Assert\Assertion;

class UpdateUserCommand
{
    private $id;
    private $name;
    private $surname;
    private $nickname;
    private $email;

    /**
     * UpdateUserCommand constructor.
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $nickname
     * @param string $email
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        int $id,
        string $name,
        string $surname,
        string $nickname,
        string $email
    )
    {
        Assertion::notBlank($id);
        Assertion::numeric($id);
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::notBlank($surname);
        Assertion::string($surname);
        Assertion::notBlank($nickname);
        Assertion::string($nickname);
        Assertion::string($nickname);
        Assertion::notBlank($email);
        Assertion::string($email);

        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->nickname = $nickname;
        $this->email = $email;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


}