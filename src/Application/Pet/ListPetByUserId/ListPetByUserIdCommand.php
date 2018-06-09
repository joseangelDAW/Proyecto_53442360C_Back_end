<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 29/05/18
 * Time: 14:20
 */

namespace App\Application\Pet\ListPetByUserId;

use Assert\Assertion;

class ListPetByUserIdCommand
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