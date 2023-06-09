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

    public function __construct(
        #[BelongsTo(target: Unit::class)]
        public Unit $unit,
        #[Column(type: 'integer')]
        public int $value,
    ) {

    }
}
