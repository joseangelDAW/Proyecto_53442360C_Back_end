<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 8:26
 */

namespace App\Application\Pet\UpdatePet;

use App\Domain\Model\Entity\Pet\PetDoesNotExistException;
use App\Domain\Model\Entity\Pet\PetRepositoryInterface;
use App\Domain\Model\Service\Entity\Pet\CheckIfPetExists;

class UpdatePet
{
    const OK = 'Mascota actualizada';
    const OK_CODE = 200;

    private $petRepository;
    private $checkIfPetExists;

    /**
     * UpdatePet constructor.
     *
     * @param PetRepositoryInterface $petRepository
     * @param CheckIfPetExists       $checkIfPetExists
     */
    public function __construct(
        PetRepositoryInterface $petRepository,
        CheckIfPetExists $checkIfPetExists
    ) {
        $this->petRepository = $petRepository;
        $this->checkIfPetExists = $checkIfPetExists;
    }

    /**
     * @param UpdatePetCommand $updatePetCommand
     *
     * @return array
     */
    public function handle(UpdatePetCommand $updatePetCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::OK_CODE];

        $petId = $updatePetCommand->getId();

        try {
            $this->checkIfPetExists->check($petId);
        } catch (PetDoesNotExistException $pnex) {
            return [ 'data' => $pnex->getMessage(), 'code' => $pnex->getCode() ];
        }

        $petEntity = $this->petRepository->findPetById($petId);

        $this->petRepository->updatePet(
            $petEntity,
            $updatePetCommand->getName(),
            $updatePetCommand->getTypePet(),
            $updatePetCommand->getSex(),
            $updatePetCommand->getRace(),
            $updatePetCommand->getBirthDate()
        );

        return $output;
    }
}