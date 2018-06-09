<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 5/06/18
 * Time: 20:44
 */

namespace App\Application\Address\ListAddressByUserId;

use Assert\Assertion;

class ListAddressByUserIdCommand
{
    private $userId;

    /**
     * ListPetByUserIdCommand constructor.
     *
     * @param int $userId
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $userId)
    {
        Assertion::notBlank($userId);
        Assertion::numeric($userId);

        $this->userId = $userId;
    }

    /**
     * Get UserId
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

}