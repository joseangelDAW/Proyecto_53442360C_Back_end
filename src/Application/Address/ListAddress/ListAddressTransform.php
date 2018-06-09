<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 7/05/18
 * Time: 19:11
 */

namespace App\Application\Address\ListAddress;

use App\Domain\Model\Entity\Address\Address;

class ListAddressTransform implements ListAddressTransformInterface
{
    /**
     * @param Address[] $queryInput
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $address) {
            $queryOutput [] =
                [
                    "id" => $address->getId(),
                    "street" => $address->getStreet(),
                    "number" => $address->getNumber(),
                    "floor" => $address->getFloor(),
                    "floor_information" => $address->getFloorInformation(),
                    "province" => $address->getProvince(),
                    "city" => $address->getCity(),
                    "cp" => $address->getCp(),
                    "user" =>
                        [
                            "name" => $address->getUser()->getName(),
                            "surname" => $address->getUser()->getSurname(),
                            "birth_date" => $address->getUser()->getBirthDate()->format('Y-m-d'),
                            "nick_name" => $address->getUser()->getNickname(),
                            "email" => $address->getUser()->getEmail()
                        ]

                ];
        }
        return $queryOutput;
    }
}