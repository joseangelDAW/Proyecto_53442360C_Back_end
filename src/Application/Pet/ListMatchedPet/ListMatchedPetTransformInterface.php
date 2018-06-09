<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 29/05/18
 * Time: 19:22
 */

namespace App\Application\Pet\ListMatchedPet;


interface ListMatchedPetTransformInterface
{
    public function transform(array $queryInput): array;
}