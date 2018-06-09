<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 5/06/18
 * Time: 20:49
 */

namespace App\Application\Address\ListAddressByUserId;

class ListAddressByUserIdTransform implements ListAddressByUserIdTransformInterface
{
    /**
     * @param $queryInput
     * @return array
     */
    public function transform($queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $address) {
            $queryOutput [] =
                [
                    "id" => $address["id"],
                    "userId" => $address["user_id"],
                    "street" => $address["street"],
                    "number" => $address["number"],
                    "floor" => $address["floor"],
                    "floorInformation" => $address["floor_information"],
                    "province" => $address["province"],
                    "city" => $address["city"],
                    "cp" => $address["cp"]
                ];
        }

        return $queryOutput;
    }
}