<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/05/18
 * Time: 19:35
 */

namespace App\Application\Pet\InsertPet;


interface InsertPetTransformInterface
{
    public function transform(array $input): array;
}