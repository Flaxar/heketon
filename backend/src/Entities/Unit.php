<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Traits\Dynamic;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasOne;
use Cycle\Annotated\Annotation\Relation\HasMany;

#[Entity]
class Unit 
{
    use Dynamic; 

    #[Column(type: 'primary')]
    public int $id;

    #[HasOne(target: Temperature::class)]
    public Temperature $temperature;

    #[HasMany(target: Window::class)]
    public array $windows;

    #[HasMany(target: Light::class)]
    public array $lights;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,
        #[Column(type: 'int')]
        public int $people,
    ) {

    }

    public function setTemperature(int $temperature): self 
    {
        $this->temperature->value = $temperature;
        return $this;
    }

    public function setWindow(int $window, bool $value): self 
    {
        $this->windows[$window]->value = $value;
        return $this;
    }

    public function setLight(int $light, int $value): self 
    {
        $this->lights[$light]->value = $value;
        return $this;
    }
}
