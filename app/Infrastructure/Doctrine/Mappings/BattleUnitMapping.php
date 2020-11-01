<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Army\Entities\Army;
use Army\Entities\BattleUnit;
use Army\Immutables\BattleUnitType;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class BattleUnitMapping extends EntityMapping
{
    public function mapFor()
    {
        return BattleUnit::class;
    }

    public function map(Fluent $builder)
    {
        $builder->bigIncrements('id')->primary();
        $builder->manyToOne(Army::class, 'army')->inversedBy('battleUnits');
        $builder->embed(BattleUnitType::class, 'type');
        $builder->integer('currentRelevanceAmount');
        $builder->boolean('active')->default('true');
        $builder->timestamps('createdAt', 'updatedAt', 'chronosDateTime');
    }
}
