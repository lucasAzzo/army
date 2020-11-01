<?php

namespace Army\Entities;

use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class Battle
{
    use Timestamps;

    private ?int $id = null;
    private Army $source;
    private Army $target;

    public function __construct(Army $source, Army $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): Army
    {
        return $this->source;
    }

    public function getTarget(): Army
    {
        return $this->target;
    }
}
