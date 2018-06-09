<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 29/05/18
 * Time: 14:20
 */

namespace App\Application\Pet\ListPetByUserId;

use App\Domain\Model\Entity\Pet\PetRepositoryInterface;

class ListPetByUserId
{

    private $listPetByUserIdTransform;
    private $petRepository;

    public function __construct(
        ListPetByUserIdTransformInterface $listPetByUserIdTransform,
        PetRepositoryInterface $petRepository
    ) {
        $this->listPetByUserIdTransform = $listPetByUserIdTransform;
        $this->petRepository = $petRepository;
    }

    public function handle(ListPetByUserIdCommand $listPetByUserIdCommand): array
    {
        $queryOutput = $this->petRepository->findPetsByUserId($listPetByUserIdCommand->getUserId());
        return $this->listPetByUserIdTransform->transform($queryOutput);
    }
}