<?php

namespace Army\Entities;

use Army\Payload\ArmyPayload;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

class Army
{
    use Timestamps;

    private ?int $id = null;
    private string $name;
    private int $coins;
    private bool $active = true;
    private Civilization $civilization;
    /** @var Collection|ArrayCollection|PersistentCollection|BattleUnit[] */
    private Collection $battleUnits;

    public function __construct(ArmyPayload $payload)
    {
        $this->name = $payload->name();
        $this->coins = $payload->coins();
        $this->civilization = $payload->civilization();
        $this->battleUnits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getCoins(): int
    {
        return $this->coins;
    }

    public function getCivilization(): Civilization
    {
        return $this->civilization;
    }

    /** @return BattleUnit[] */
    public function getBattleUnits(): array
    {
        return $this->battleUnits->filter(function (BattleUnit $battleUnit) {
            return $battleUnit->isActive();
        })->toArray();
    }

    public function trainUnit(BattleUnit $battleUnit): void
    {
        if (! $this->canTrain($battleUnit)) {
            throw new \InvalidArgumentException('Not enough coins to train this type of unit');
        }

        $this->battleUnits->removeElement($battleUnit);
        $battleUnit->train();
        $this->battleUnits->add($battleUnit);
    }

    public function battleWith(Army $targetArmy): void
    {
        if ($this->coins > $targetArmy->getCoins()) {
            $this->coins += config('army.amountPerBattleWon');
            $targetArmy->deactivateBestUnits(config('army.quantityOfUnitLossesPerBattle'));

            return;
        }

        if ($this->coins < $targetArmy->getCoins()) {
            $targetArmy->coins += config('army.amountPerBattleWon');
            $this->deactivateBestUnits(config('army.quantityOfUnitLossesPerBattle'));

            return;
        }

        /* si es empate, ambos pierden las dos mejores unidades (decision propia) */
        if ($this->coins === $targetArmy->getCoins()) {
            $targetArmy->deactivateBestUnits(config('army.quantityOfUnitLossesPerBattle'));
            $targetArmy->deactivateBestUnits(config('army.quantityOfUnitLossesPerBattle'));
        }
    }

    public function deactivateBestUnits(int $quantityOfLosses): void
    {
        /** @var BattleUnit[] $units */
        $units = collect($this->getBattleUnits())->sortBy(function (BattleUnit $battleUnit) {
            return $battleUnit->getType()->getValue();
        })->sortBy(function (BattleUnit $battleUnit) {
            return $battleUnit->getCurrentRelevanceAmount();
        })->toArray();

        for ($i = 0; $i < $quantityOfLosses; ++$i) {
            $this->battleUnits->removeElement($units[$i]);
            $units[$i]->deactivate();
            $this->battleUnits->add($units[$i]);
        }
    }

    public function deactivate(): void
    {
        $this->active = false;
    }

    public function canTrain(BattleUnit $battleUnit): bool
    {
        if (config("army.units.{$battleUnit->getType()->getValue()}.costOfTraining") > $this->coins) {
            return false;
        }

        return true;
    }
}
