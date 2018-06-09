<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 9:39
 */

namespace App\Application\News\InsertNews;

interface InsertNewsTransformInterface
{
    public function transform(array $queryInput): array;
}