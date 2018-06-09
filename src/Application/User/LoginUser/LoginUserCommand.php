<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 19/05/18
 * Time: 9:31
 */

namespace App\Application\User\LoginUser;


use Assert\Assertion;

class LoginUserCommand
{
    private $user;
    private $password;
    private $role;

    /**
     * LoginUserCommand constructor.
     * @param string $user
     * @param string $password
     * @param string $role
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        string $user,
        string $password,
        string $role
    )
    {
        Assertion::string($user);
        Assertion::notBlank($user);
        Assertion::string($role);
        Assertion::notBlank($role);
        $this->user = $user;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }




}