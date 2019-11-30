<?php

return [
    [
        'name'       => 'jira_id',
        'type'       => 'text',
        'label'      => 'Jira Id',
        'hint'       => 'Eg: AUGMENTO-786', // helpful text, shows up after the input
        'attributes' => [
            'placeholder' => 'JIRA ID',
        ],
        'importable' => true
    ],
    [
        'name'              => 'module_id',
        'type'              => 'select2',
        'label'             => 'Module Name',
        'entity'            => 'module', // the method that defines the relationship in your Model
        'attribute'         => 'name', // foreign key attribute that is shown to user
        'model'             => "App\Models\Module",
        'importable'        => true,    
    ],
    [
        'name'       => 'is_regression',
        'type'       => 'checkbox',
        'label'      => 'Is Regression?',
        'importable' => true
    ],
    [
        'name'   => 'release_version',
        'type'   => 'text',
        'label'  => 'Release/Fix Version',
        'prefix' => 'v',
        'importable' => true
    ],
    [
        'name'       => 'objective',
        'type'       => 'text',
        'label'      => 'Test Objective',
        'importable' => true,
    ],
    [
        'name'       => 'steps',
        'type'       => 'textarea',
        'label'      => 'Test Steps',
        'importable' => true,
    ],
    [
        'name'       => 'data',
        'type'       => 'textarea',
        'label'      => 'Test Data',
        'importable' => true,
    ],
    [
        'name'       => 'expected_result',
        'type'       => 'textarea',
        'label'      => 'Expected Result',
        'importable' => true,
    ],
    [
        'name'       => 'actual_result',
        'type'       => 'textarea',
        'label'      => 'Actual Result',
        'importable' => true,
    ],
];

