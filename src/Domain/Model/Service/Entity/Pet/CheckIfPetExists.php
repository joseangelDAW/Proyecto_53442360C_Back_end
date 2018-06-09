<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 8:52
 */

namespace App\Domain\Model\Service\Entity\Pet;

use App\Domain\Model\Entity\Pet\PetDoesNotExistException;
use App\Domain\Model\Entity\Pet\PetRepositoryInterface;

class CheckIfPetExists
{
    private $petRepository;

    /**
     * CheckIfPetExists constructor.
     *
     * @param PetRepositoryInterface $petRepository
     */
    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    /**
     * @param int $id
     *
     * @throws PetDoesNotExistException
     */
    public function check(int $id): void
    {
        if (is_null($this->petRepository->findPetById($id))) {
            throw new PetDoesNotExistException();
        }
    }
}