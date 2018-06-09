<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 9:16
 */

namespace App\Infrastructure\Repository\News;

use App\Domain\Model\Entity\News\EntryEntity;
use App\Domain\Model\Entity\News\EntryEntityRepositoryInterface;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class EntryEntityRepository extends ServiceEntityRepository implements EntryEntityRepositoryInterface
{
    /**
     * @return array
     */
    public function listEntries(): array
    {
        return $this->findAll();
    }

    /**
     * @param string $title
     * @param string $content
     *
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertEntry(
        string $title,
        string $content
    ): int {
        $entry = new EntryEntity();
        $entry->setTitle($title);
        $entry->setContent($content);
        $entry->setDateEntry(new DateTime('now'));

        $this->persistAndFlush($entry);

        return $entry->getId();
    }

    /**
     * @param int $id
     * @return EntryEntity|null
     */
    public function findNewsById(int $id): ?EntryEntity
    {
        return $this->findOneBy(["id" => $id]);
    }

    /**
     * @param int $entryId
     * @param string $uri
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setUrlNewsImage(int $entryId, string $uri)
    {
        $entryEntity = $this->findNewsById($entryId);
        $entryEntity->setImage($uri);

        $this->persistAndFlush($entryEntity);
    }

    /**
     * @param EntryEntity $entry
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persistAndFlush(EntryEntity $entry): void
    {
        $this->getEntityManager()->persist($entry);
        $this->getEntityManager()->flush();

    }
}