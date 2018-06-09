<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 7/05/18
 * Time: 19:12
 */

namespace App\Application\Address\ListAddress;


interface ListAddressTransformInterface
{
    public function transform(array $queryInput): array;
}