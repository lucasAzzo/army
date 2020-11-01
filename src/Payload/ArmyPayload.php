<?php

namespace Army\Payload;

use Army\Entities\Civilization;

interface ArmyPayload
{
    public function coins(): int;

    public function civilization(): Civilization;

    public function name(): string;
}
