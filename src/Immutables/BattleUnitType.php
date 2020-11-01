<?php

namespace Army\Immutables;

class BattleUnitType
{
    public const PIQUERO = 1;
    public const ARQUERO = 2;
    public const CABALLERO = 3;

    private const TRANSITIONS = [
      self::PIQUERO => self::ARQUERO,
      self::ARQUERO => self::CABALLERO,
      self::CABALLERO => null,
    ];

    private ?string $value = null;

    public function __construct(string $value = null)
    {
        static::assert($value);

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->getValue() ?? '';
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function transition(): BattleUnitType
    {
        if (! $this->canTransition()) {
            throw new \InvalidArgumentException('Type can\'t transition from ' . $this->value);
        }

        return new static(static::TRANSITIONS[$this->value]);
    }

    public function canTransition(): bool
    {
        return ! is_null(static::TRANSITIONS[$this->value]);
    }

    public static function getAllValues(): array
    {
        $oClass = new \ReflectionClass(get_called_class());

        return array_values($oClass->getConstants());
    }

    private static function assert(string $name = null)
    {
        if (! in_array($name, static::getAllValues(), false)) {
            throw new \InvalidArgumentException('Invalid Type');
        }
    }
}
