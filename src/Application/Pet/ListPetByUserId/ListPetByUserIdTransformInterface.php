<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 29/05/18
 * Time: 14:21
 */

namespace App\Application\Pet\ListPetByUserId;

interface ListPetByUserIdTransformInterface
{
    public function transform($queryOutput): array;
}