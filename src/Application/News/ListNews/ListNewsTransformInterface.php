<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 10:06
 */

namespace App\Application\News\ListNews;

interface ListNewsTransformInterface
{
    public function transform(array $queryInput): array;
}