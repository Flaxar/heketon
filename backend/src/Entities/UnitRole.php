<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\ManyToMany;

#[Entity]
class UnitRole
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'integer')]
        public int $role,
        #[ManyToMany(target: Unit::class, though: UnitRole::class)]
        public Unit $unit,
        #[ManyToMany(target: User::class, though: UnitRole::class)]
        public User $user,
    ) {

    }
}
