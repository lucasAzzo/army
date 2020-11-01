<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Army\Immutables\BattleUnitType;
use LaravelDoctrine\Fluent\EmbeddableMapping;
use LaravelDoctrine\Fluent\Fluent;

class BattleUnitTypeMapping extends EmbeddableMapping
{
    public function mapFor()
    {
        return BattleUnitType::class;
    }

    public function map(Fluent $builder)
    {
        $builder->text('value');
    }
}
