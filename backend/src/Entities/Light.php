<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

#[Entity]
class Temperature
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    #[BelongsTo(target: Unit::class, nullable: false)]
    public Unit $unit;

    public function __construct(
        #[Column(type: 'int')]
        public int $state,
    ) {

    }
}
