<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 9:39
 */

namespace App\Application\News\InsertNews;

use App\Domain\Model\Entity\News\EntryEntityRepositoryInterface;

class InsertNews
{
    const OK_CODE = 200;
    const OK = "Ok";

    private $entryEntityRepository;

    public function __construct(
        EntryEntityRepositoryInterface $entryEntityRepository
    ) {
        $this->entryEntityRepository = $entryEntityRepository;
    }

    public function handle(InsertNewsCommand $insertNewsCommand): array
    {
        //$output = ['data' => self::OK, 'code' => self::OK_CODE];

        $entryId = $this->entryEntityRepository->insertEntry(
            $insertNewsCommand->getTitle(),
            $insertNewsCommand->getContent()
        );

        return [
            "data" => self::OK,
            "code" => self::OK_CODE,
            "message" => "Entrada insertada",
            "returnValue" => $entryId
        ];
    }
}