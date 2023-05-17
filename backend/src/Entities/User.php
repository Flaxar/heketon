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
    protected array $roles = [];

    #[Column(type: 'string')]
    public string $password;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,
        string $password,
        #[Column(type: 'boolean')]
        public int $admin,
    ) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function can(int $unit, int $role): bool
    {
        foreach ($this->roles as $unitRole) {
            if ($unitRole->unit->id === $unit && $unitRole->role === $role) {
                return true;
            }
        }

        return false;
    }
}
