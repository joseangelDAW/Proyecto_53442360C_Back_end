<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29/05/18
 * Time: 19:21
 */

namespace App\Application\Pet\ListMatchedPet;

use App\Domain\Model\Entity\Pet\PetRepositoryInterface;

class ListMatchedPet
{
    private $listMatchedPetTransform;
    private $petRepository;

    public function __construct(
        ListMatchedPetTransformInterface $listMatchedPetTransform,
        PetRepositoryInterface $petRepository
    ) {
        $this->listMatchedPetTransform = $listMatchedPetTransform;
        $this->petRepository = $petRepository;
    }

    public function handle(ListMatchedPetCommand $listMatchedPetCommand): array
    {
        $queryOutput = $this->petRepository->findMatchedPet(
            $listMatchedPetCommand->getTypePet(),
            $listMatchedPetCommand->getSex(),
            $listMatchedPetCommand->getRace(),
            $listMatchedPetCommand->getUserId()
        );
        return $this->listMatchedPetTransform->transform($queryOutput);
    }

}