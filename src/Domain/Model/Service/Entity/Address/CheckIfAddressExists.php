<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 20:11
 */

namespace App\Domain\Model\Service\Entity\Address;

use App\Domain\Model\Entity\Address\AddressDoesNotExistException;
use App\Domain\Model\Entity\Address\AddressRepositoryInterface;

class CheckIfAddressExists
{
    private $addressRepository;

    /**
     * CheckIfAddressExists constructor.
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param int $id
     *
     * @throws AddressDoesNotExistException
     */
    public function check(int $id): void
    {
        if (is_null($this->addressRepository->findAddressById($id))) {
            throw new AddressDoesNotExistException();
        }
    }
}