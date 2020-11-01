<?php

namespace Army\Entities;

use Army\Payload\CivilizationPayload;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class Civilization
{
    use Timestamps;

    private ?int $id = null;
    private string $name;

    public function __construct(CivilizationPayload $payload)
    {
        $this->name = $payload->name();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
