<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 6/05/18
 * Time: 18:51
 */

namespace App\Application\Address\InsertAddress;

use App\Domain\Model\Entity\Address\AddressRepositoryInterface;
use App\Domain\Model\Entity\User\UserDoesNotExistException;
use App\Domain\Model\Entity\User\UserRepositoryInterface;
use App\Domain\Model\Service\Entity\User\CheckIfUserExists;

class InsertAddress
{
    const OK = 'Dirección insertada';
    const OK_CODE = 200;

    private $addressRepository;
    private $userRepository;
    private $checkIfUserExists;

    /**
     * InsertAddress constructor.
     * @param AddressRepositoryInterface $addressRepository
     * @param UserRepositoryInterface $userRepository
     * @param CheckIfUserExists $checkIfUserExists
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository,
        UserRepositoryInterface $userRepository,
        CheckIfUserExists $checkIfUserExists

    ) {
        $this->addressRepository = $addressRepository;
        $this->userRepository = $userRepository;
        $this->checkIfUserExists = $checkIfUserExists;
    }

    /**
     * @param InsertAddressCommand $insertAddressCommand
     * @return array
     */
    public function handle(InsertAddressCommand $insertAddressCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::OK_CODE];

        $userId = $insertAddressCommand->getUserId();
        try {
            $this->checkIfUserExists->check($userId);
        } catch (UserDoesNotExistException $unex) {
            return [ 'data' => $unex->getMessage(), 'code' => $unex->getCode() ];
        }

        $userEntity = $this->userRepository->findUserById($userId);

        $this->addressRepository->insertAddress(
            $insertAddressCommand->getStreet(),
            $insertAddressCommand->getNumber(),
            $userEntity,
            $insertAddressCommand->getFloor(),
            $insertAddressCommand->getFloorInformation(),
            $insertAddressCommand->getProvince(),
            $insertAddressCommand->getCity(),
            $insertAddressCommand->getCp()
        );

        return $output;
    }
}