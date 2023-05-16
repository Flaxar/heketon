<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity]
class Unit 
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,
        #[Column(type: 'int')]
        public int $people,
    ) {

    }
}
