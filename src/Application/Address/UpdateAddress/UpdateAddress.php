<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 17:51
 */

namespace App\Application\Address\UpdateAddress;

use App\Domain\Model\Entity\Address\AddressDoesNotExistException;
use App\Domain\Model\Entity\Address\AddressRepositoryInterface;
use App\Domain\Model\Service\Entity\Address\CheckIfAddressExists;

class UpdateAddress
{
    const OK = 'Dirección actualizada';
    const OK_CODE = 200;
    private $addressRepository;
    private $updateAddressTransform;
    private $checkIfAddressExists;

    public function __construct(
        AddressRepositoryInterface $addressRepository,
        UpdateAddressTransformInterface $updateAddressTransform,
        CheckIfAddressExists $checkIfAddressExists
    ) {
        $this->addressRepository = $addressRepository;
        $this->updateAddressTransform = $updateAddressTransform;
        $this->checkIfAddressExists = $checkIfAddressExists;
    }

    public function handle(UpdateAddressCommand $updateAddressCommand)
    {
        $output = ['data' => self::OK, 'code' => self::OK_CODE];

        $addressId = $updateAddressCommand->getId();

        try {
            $this->checkIfAddressExists->check($addressId);
        } catch (AddressDoesNotExistException $anex) {
            return ['data' => $anex->getMessage(), 'code' => $anex->getCode()];
        }

        $addressEntity = $this->addressRepository->findAddressById($addressId);

        $this->addressRepository->updateAddress(
            $addressEntity,
            $updateAddressCommand->getStreet(),
            $updateAddressCommand->getNumber(),
            $updateAddressCommand->getFloor(),
            $updateAddressCommand->getFloorInformation(),
            $updateAddressCommand->getProvince(),
            $updateAddressCommand->getCity(),
            $updateAddressCommand->getCp()
        );
        $this->addressRepository->persistAndFlush($addressEntity);

        return $output;
    }
}