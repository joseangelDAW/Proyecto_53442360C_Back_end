<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 5/06/18
 * Time: 20:48
 */

namespace App\Application\Address\ListAddressByUserId;


interface ListAddressByUserIdTransformInterface
{
    public function transform($queryOutput): array;

}