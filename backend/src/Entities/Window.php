<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

#[Entity]
class Window 
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[BelongsTo(target: Unit::class, nullable: false)]
        public Unit $unit,
        #[Column(type: 'bool')]
        public bool $state,
    ) {

    }
}
