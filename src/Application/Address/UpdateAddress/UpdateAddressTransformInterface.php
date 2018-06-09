<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/18
 * Time: 17:51
 */

namespace App\Application\Address\UpdateAddress;


interface UpdateAddressTransformInterface
{
    public function transform(array $input): array;
}