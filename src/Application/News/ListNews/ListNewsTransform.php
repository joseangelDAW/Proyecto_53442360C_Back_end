<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 10:06
 */

namespace App\Application\News\ListNews;

use App\Domain\Model\Entity\News\EntryEntity;

class ListNewsTransform implements ListNewsTransformInterface
{
    /**
     * @param EntryEntity[] $queryInput
     *
     * @return array
     */
    public function transform(array $queryInput): array
    {
        $queryOutput = [];
        foreach ($queryInput as $entryEntity) {
            $queryOutput [] =
                [
                    "title"   => $entryEntity->getTitle(),
                    "image"   => $entryEntity->getImage(),
                    "content" => $entryEntity->getContent(),
                    "dateNews" => $entryEntity->getDateEntry()->format('d-m-Y')
                ];
        }

        return $queryOutput;
    }
}
