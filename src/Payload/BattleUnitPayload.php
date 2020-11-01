<?php

namespace Army\Payload;

use Army\Entities\Army;
use Army\Immutables\BattleUnitType;

interface BattleUnitPayload
{
    public function army(): Army;

    public function type(): BattleUnitType;
}
