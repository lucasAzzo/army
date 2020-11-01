<?php

namespace Army\Entities;

use Army\Immutables\BattleUnitType;
use Army\Payload\BattleUnitPayload;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class BattleUnit
{
    use Timestamps;

    private ?int $id = null;
    private Army $army;
    private BattleUnitType $type;
    private int $currentRelevanceAmount;
    private bool $active = true;

    public function __construct(BattleUnitPayload $payload)
    {
        $this->army = $payload->army();
        $this->type = $payload->type();
        $this->currentRelevanceAmount = config("army.units.{$this->type->getValue()}.initialAmount");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArmy(): Army
    {
        return $this->army;
    }

    public function getType(): BattleUnitType
    {
        return $this->type;
    }

    public function getCurrentRelevanceAmount(): int
    {
        return $this->currentRelevanceAmount;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function deactivate(): void
    {
        $this->active = false;
    }

    public function train(): void
    {
        $this->currentRelevanceAmount += config("army.units.{$this->type->getValue()}.amountPerTraining");

        if ($this->type->canTransition() && $this->currentRelevanceAmount >= config("army.units.{$this->type->getValue()}.amountToTransition")) {
            $this->type = $this->type->transition();
            $this->currentRelevanceAmount = config("army.units.{$this->type->getValue()}.initialAmount");
        }
    }
}
