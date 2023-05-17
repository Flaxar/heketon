<?php

namespace App;

class Message
{
    public function __construct(
        public readonly array $data,
    ) {

    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] 
            ?? ($default === null 
                ? throw new SkillIssue("Key $key not found") 
                : $default
            );
    }
}
