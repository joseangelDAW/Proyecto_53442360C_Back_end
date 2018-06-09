<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 8/05/18
 * Time: 21:37
 */

namespace App\Application\Address\ListAddressByKey;

use App\Domain\Model\Entity\Address\AddressRepositoryInterface;

class ListAddressByKey
{
    private $listAddressByKeyTransform;
    private $addressRepository;

    public function __construct(
        ListAddressByKeyTransformInterface $listAddressByKeyTransform,
        AddressRepositoryInterface $addressRepository
    ) {
        $this->listAddressByKeyTransform = $listAddressByKeyTransform;
        $this->addressRepository = $addressRepository;
    }

    public function handle(ListAddressByKeyCommand $listAddressByKeyCommand): array
    {
        $queryOutput = $this->addressRepository
            ->findAddressByKey(
                $listAddressByKeyCommand->getKey(),
                $listAddressByKeyCommand->getValue()
            );
        return $this->listAddressByKeyTransform->transform($queryOutput);
    }
}