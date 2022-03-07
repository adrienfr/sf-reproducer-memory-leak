<?php

namespace App\Tests\Utils;

use Doctrine\ORM\EntityManagerInterface;
use Prophecy\Prophet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class CreateEntityKernelTestCase extends KernelTestCase
{
    /** @var EntityManagerInterface */
    protected $em;

    /** @var PropertyAccessor */
    protected $propertyAccessor;

    /** @var Prophet */
    protected $prophet;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
        $this->em->beginTransaction();
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        $this->prophet = new Prophet();
    }

    protected function tearDown(): void
    {
        $this->em->rollBack();
        $this->em->close();
        $this->em = null;
        $this->propertyAccessor = null;
        $this->prophet = null;

        parent::tearDown();

        echo sprintf("Memory usage: %d MB\n", round(memory_get_usage() / 1024 / 1024));
    }

    protected function createEntity(string $class, array $data, bool $flush = true)
    {
        $entity = new $class();

        foreach ($data as $field => $value) {
            $this->propertyAccessor->setValue($entity, $field, $value);
        }

        $this->em->persist($entity);

        if ($flush) {
            $this->em->flush();
        }

        return $entity;
    }
}
