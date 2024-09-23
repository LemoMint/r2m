<?php

namespace App\Tests\Helper;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\Driver\Session;

trait DoctrineTransactionRollbackHelper
{
    use DIHelper;

    protected EntityManagerInterface $em;
    protected DocumentManager $dm;
    protected Session $mongoSession;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = $this->getService('doctrine.orm.entity_manager');
        $this->em->beginTransaction();

        $this->dm = $this->getService('doctrine_mongodb.odm.document_manager');
        $this->mongoSession = $this->dm->getClient()->startSession();
    }

    protected function tearDown(): void
    {
        $this->em->getConnection()->rollBack();
        $this->em->close();
        unset($this->entityManager);

        $this->mongoSession->abortTransaction();
        $this->mongoSession->endSession();
        unset($this->mongoSession);
        $this->dm->clear();
        unset($this->dm);

        parent::tearDown();
    }
}