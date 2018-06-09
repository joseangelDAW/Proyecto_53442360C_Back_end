<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 7/05/18
 * Time: 19:11
 */

namespace App\Application\Address\ListAddress;


use App\Domain\Model\Entity\Address\AddressRepositoryInterface;

class ListAddress
{
    private $listAddressTransform;
    private $addressRepository;

    public function __construct(
        ListAddressTransformInterface $listAddressTransform,
        AddressRepositoryInterface $addressRepository
    )
    {
        $this->listAddressTransform = $listAddressTransform;
        $this->addressRepository = $addressRepository;
    }

    public function handle(ListAddressCommand $listAddressCommand): array
    {
        $queryOutput = $this->addressRepository->listAddress();
        return $this->listAddressTransform->transform($queryOutput);
    }
}