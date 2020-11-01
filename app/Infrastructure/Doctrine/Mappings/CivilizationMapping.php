<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Army\Entities\Civilization;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class CivilizationMapping extends EntityMapping
{
    public function mapFor()
    {
        return Civilization::class;
    }

    public function map(Fluent $builder)
    {
        $builder->bigIncrements('id')->primary();
        $builder->text('name');
        $builder->timestamps('createdAt', 'updatedAt', 'chronosDateTime');
    }
}
