<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Army\Entities\Army;
use Army\Entities\BattleUnit;
use Army\Entities\Civilization;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class ArmyMapping extends EntityMapping
{
    public function mapFor()
    {
        return Army::class;
    }

    public function map(Fluent $builder)
    {
        $builder->bigIncrements('id')->primary();
        $builder->text('name');
        $builder->integer('coins');
        $builder->boolean('active')->default('true');
        $builder->manyToOne(Civilization::class, 'civilization');
        $builder->oneToMany(BattleUnit::class, 'battleUnits')->mappedBy('army')->cascadePersist();
        $builder->timestamps('createdAt', 'updatedAt', 'chronosDateTime');
    }
}
