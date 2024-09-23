<?php

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Domain\Repository\RepositoryInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository as BaseDocumentRepository;

abstract class DocumentRepository extends BaseDocumentRepository implements RepositoryInterface
{
    public function __construct(DocumentManager $dm, string $documentClass)
    {
        parent::__construct($dm, $dm->getUnitOfWork(), $dm->getClassMetadata($documentClass));
    }

    public function findOneByUlid(string $ulid): ?object
    {
        return $this->findOneBy(['ulid' => $ulid]);
    }

    /**
     * @throws MongoDBException
     */
    public function add($entity, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($entity);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    /**
     * @throws MongoDBException
     */
    public function remove($entity, bool $flush = false): void
    {
        $this->getDocumentManager()->remove($entity);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }
}