<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasMany;

#[Entity]
class User
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    #[HasMany(target: UnitRole::class)]
    public array $roles;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,
        #[Column(type: 'string')]
        public string $password,
        #[Column(type: 'boolean')]
        public int $admin,
    ) {

    }
}
