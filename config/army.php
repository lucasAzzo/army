<?php

return [
    'amountPerWinBattleWon' => env('ARMY_AMOUNT_PER_BATTLE_WON', 1000),
    'quantityOfUnitLossesPerBattle' => env('ARMY_QUANTITY_OF_UNIT_LOSSES_PER_BATTLE', 2),
    'units' => [
        1 => [
            'initialAmount' => env('ARMY_UNITS_PIQUERO_INITIAL_AMOUNT', 5),
            'amountPerTraining' => env('ARMY_UNITS_PIQUERO_AMOUNT_PER_TRAINING', 3),
            'amountToTransition' => env('ARMY_UNITS_PIQUERO_AMOUNT_TO_TRANSITION', 30),
            'costOfTraining' => env('ARMY_UNITS_PIQUERO_COST_OF_TRAINING', 10),
        ],
        2 => [
            'initialAmount' => env('ARMY_UNITS_ARQUERO_INITIAL_AMOUNT', 10),
            'amountPerTraining' => env('ARMY_UNITS_ARQUERO_AMOUNT_PER_TRAINING', 7),
            'amountToTransition' => env('ARMY_UNITS_ARQUERO_AMOUNT_TO_TRANSITION', 40),
            'costOfTraining' => env('ARMY_UNITS_ARQUERO_COST_OF_TRAINING', 20),
        ],
        3 => [
            'initialAmount' => env('ARMY_UNITS_CABALLERO_INITIAL_AMOUNT', 20),
            'amountPerTraining' => env('ARMY_UNITS_CABALLERO_AMOUNT_PER_TRAINING', 10),
            'costOfTraining' => env('ARMY_UNITS_CABALLERO_COST_OF_TRAINING', 30),
        ],
    ],
];
