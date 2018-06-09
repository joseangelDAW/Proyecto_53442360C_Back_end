<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/05/18
 * Time: 19:35
 */

namespace App\Application\Pet\InsertPet;


use App\Domain\Model\Entity\Pet\PetRepositoryInterface;
use App\Domain\Model\Entity\User\UserDoesNotExistException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Domain\Model\Service\Entity\User\CheckIfUserExists;

class InsertPet
{
    const OK = 'Mascota insertada';
    const OK_CODE = 200;

    private $petRepository;
    private $userRepository;
    private $checkIfUserExists;

    /**
     * InsertAddress constructor.
     * @param PetRepositoryInterface $petRepository
     * @param UserRepositoryInterface $userRepository
     * @param CheckIfUserExists $checkIfUserExists
     */
    public function __construct(
        PetRepositoryInterface $petRepository,
        UserRepositoryInterface $userRepository,
        CheckIfUserExists $checkIfUserExists

    ) {
        $this->petRepository = $petRepository;
        $this->userRepository = $userRepository;
        $this->checkIfUserExists = $checkIfUserExists;
    }

    /**
     * @param InsertPetCommand $insertPetCommand
     * @return array
     */
    public function handle(InsertPetCommand $insertPetCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::OK_CODE];

        $userId = $insertPetCommand->getUserId();
        try {
            $this->checkIfUserExists->check($userId);
        } catch (UserDoesNotExistException $unex) {
            return [ 'data' => $unex->getMessage(), 'code' => $unex->getCode() ];
        }

        $userEntity = $this->userRepository->findUserById($userId);

        $this->petRepository->insertPet(
            $insertPetCommand->getName(),
            $insertPetCommand->getTypePet(),
            $insertPetCommand->getSex(),
            $insertPetCommand->getRace(),
            $userEntity,
            $insertPetCommand->getBirthDate()
        );

        return $output;
    }
}