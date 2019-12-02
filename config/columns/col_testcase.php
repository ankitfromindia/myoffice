<?php

return [
    [
        // 1-n relationship
        'label'     => "Module", // Table column heading
        'type'      => "select",
        'name'      => 'module_id', // the column that contains the ID of that connected entity;
        'entity'    => 'module', // the method that defines the relationship in your Model
        'attribute' => "name", // foreign key attribute that is shown to user
        'model'     => "App\Models\Module",
    ],
    [
        'name'     => 'objective',
        'label'    => "Test Case Objective",
        'type'     => 'text',
        'function' => function($entry){
            return nl2br($entry->objective);
        },
        'limit' => 200
    ],
    [
        'name'  => 'steps',
        'label' => "Test Steps",
        'type'  => 'text',
        'limit' => 200
    ],
    [
        'name'  => 'data',
        'label' => "Test Data",
        'type'  => 'text'
    ],
    [
        'name'  => 'expected_result',
        'label' => "Expected Result",
        'type'  => 'text'
    ],
    [
        'name'    => 'status',
        'label'   => "Status",
        'type'    => 'boolean',
        'options' => [
            0 => 'Not Executed',
            1 => 'Passed',
            2 => 'Failed'
        ]
    ],
];
