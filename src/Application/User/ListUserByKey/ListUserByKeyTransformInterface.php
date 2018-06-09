<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 15/05/18
 * Time: 20:57
 */

namespace App\Application\User\ListUserByKey;


interface ListUserByKeyTransformInterface
{
    public function transform(array $queryInput): array;
}