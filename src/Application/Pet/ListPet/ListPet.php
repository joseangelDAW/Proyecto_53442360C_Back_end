<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 17/05/18
 * Time: 17:38
 */

namespace App\Application\Pet\ListPet;


use App\Domain\Model\Entity\Pet\PetRepositoryInterface;

class ListPet
{
    private $listPetTransform;
    private $petRepository;

    public function __construct(
        ListPetTransformInterface $listPetTransform,
        PetRepositoryInterface $petRepository
    ) {
        $this->listPetTransform = $listPetTransform;
        $this->petRepository = $petRepository;
    }

    public function handle(ListPetCommand $listPetCommand): array
    {
        $queryOutput = $this->petRepository->listPet();
        return $this->listPetTransform->transform($queryOutput);
    }
}