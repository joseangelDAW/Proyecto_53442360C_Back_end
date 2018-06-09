<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 10:06
 */

namespace App\Application\News\ListNews;

use App\Domain\Model\Entity\News\EntryEntityRepositoryInterface;

class ListNews
{
    private $listNewsTransform;
    private $entryEntityRepository;

    public function __construct(
        ListNewsTransformInterface $listNewsTransform,
        EntryEntityRepositoryInterface $entryEntityRepository
    ) {
        $this->listNewsTransform = $listNewsTransform;
        $this->entryEntityRepository = $entryEntityRepository;
    }

    public function handle(ListNewsCommand $listNewsCommand): array
    {
        $queryOutput = $this->entryEntityRepository->listEntries();
        return $this->listNewsTransform->transform($queryOutput);
    }
}