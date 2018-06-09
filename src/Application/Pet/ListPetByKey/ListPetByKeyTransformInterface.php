<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 17/05/18
 * Time: 15:13
 */
namespace App\Application\Pet\ListPetByKey;

interface ListPetByKeyTransformInterface
{
    public function transform(array $input): array;
}