<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 8/05/18
 * Time: 21:38
 */

namespace App\Application\Address\ListAddressByKey;


interface ListAddressByKeyTransformInterface
{
    public function transform(array $queryInput): array;
}