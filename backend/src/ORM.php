<?php

declare(strict_types=1);

namespace App;

use Cycle\Annotated;
use Cycle\Database\Config\DatabaseConfig;
use Cycle\Database\DatabaseManager;
use Cycle\ORM\EntityManager;
use Cycle\ORM\EntityManagerInterface;
use Cycle\ORM\Factory;
use Cycle\ORM\Heap\Heap;
use Cycle\ORM\ORM as CycleORM;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Schema as ORMSchema;
use Cycle\Schema;
use Doctrine\Common\Annotations\AnnotationRegistry;

class ORM 
{
    public readonly DatabaseManager $dbal;

    public readonly EntityManagerInterface $manager;

    private readonly ORMInterface $orm;

    public function __construct(
        public readonly Config $config,
    ) {
        $this->dbal = new DatabaseManager(new DatabaseConfig($this->config->database));

        $finder = (new \Symfony\Component\Finder\Finder())->files()->in([__DIR__]);
        $locator = new \Spiral\Tokenizer\ClassLocator($finder);

        AnnotationRegistry::registerLoader('class_exists');

        $modules = [
            new Schema\Generator\ResetTables(),
            new Annotated\Embeddings($locator),
            new Annotated\Entities($locator),
            new Annotated\TableInheritance(),
            new Annotated\MergeColumns(),
            new Schema\Generator\GenerateRelations(),
            new Schema\Generator\GenerateModifiers(),
            new Schema\Generator\ValidateEntities(),
            new Schema\Generator\RenderTables(),
            new Schema\Generator\RenderRelations(),
            new Schema\Generator\RenderModifiers(),
            new Annotated\MergeIndexes(),
            new Schema\Generator\GenerateTypecast(),
        ];

        if ($config->debug) {
            $modules[] = new Schema\Generator\SyncTables();
        }

        $schema = (new Schema\Compiler())->compile(new Schema\Registry($this->dbal), $modules);

        $this->orm = new CycleORM(new Factory($this->dbal), new ORMSchema($schema));
        $this->manager = new EntityManager($this->orm);
    }

    public function getORM(): ORMInterface
    {
        return $this->orm;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->manager;
    }
}
