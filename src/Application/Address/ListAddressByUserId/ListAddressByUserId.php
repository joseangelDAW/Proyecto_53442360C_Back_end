<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 5/06/18
 * Time: 20:45
 */

namespace App\Application\Address\ListAddressByUserId;

use App\Domain\Model\Entity\Address\AddressRepositoryInterface;

class ListAddressByUserId
{
    private $listAddressByUserIdTransform;
    private $addressRepository;

    public function __construct(
        ListAddressByUserIdTransformInterface $listAddressByUserIdTransform,
        AddressRepositoryInterface $addressRepository
    ) {
        $this->listAddressByUserIdTransform = $listAddressByUserIdTransform;
        $this->addressRepository = $addressRepository;
    }

    public function handle(ListAddressByUserIdCommand $listAddressByUserIdCommand): array
    {
        $queryOutput = $this->addressRepository->findAddressByUserId($listAddressByUserIdCommand->getUserId());
        return $this->listAddressByUserIdTransform->transform($queryOutput);
    }

}