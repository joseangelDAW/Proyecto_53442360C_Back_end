<?php

namespace App\Application\Pet\ListPetByKey;

use App\Domain\Model\Entity\Pet\PetRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 15:12
 */

class ListPetByKey
{
    private $petRepository;
    private $listPetByKeyTransform;


    public function __construct(
        PetRepositoryInterface $petRepository,
        ListPetByKeyTransformInterface $listPetByKeyTransform
    ) {
        $this->petRepository = $petRepository;
        $this->listPetByKeyTransform = $listPetByKeyTransform;
    }

    public function handle(ListPetByKeyCommand $listPetByKeyCommand)
    {
        $queryOutput = $this->petRepository
            ->findPetByKey(
                $listPetByKeyCommand->getKey(),
                $listPetByKeyCommand->getValue()
            );
        return $this->listPetByKeyTransform->transform($queryOutput);
    }
}