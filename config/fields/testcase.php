<?php

return [
    [
        'name'       => 'jira_id',
        'type'       => 'text',
        'label'      => 'Jira Id',
        'prefix'     => 'AUGMENTO-',
        'hint'       => 'Eg: AUGMENTO-786', // helpful text, shows up after the input
        'attributes' => [
            'placeholder' => 'AUGMENTO JIRA ID',
        ]
    ],
    [
        'name'      => 'module_id',
        'type'      => 'select2',
        'label'     => 'Module Name',
        'entity'    => 'module', // the method that defines the relationship in your Model
        'attribute' => 'name', // foreign key attribute that is shown to user
        'model'     => "App\Models\Module",
    ],
    [
        'name'  => 'is_regression',
        'type'  => 'checkbox',
        'label' => 'Is Regression?',
    ],
    [
        'name'  => 'release_version',
        'type'  => 'text',
        'label' => 'Release/Fix Version',
        'prefix' => 'v'
    ],
    [
        'name'  => 'objective',
        'type'  => 'text',
        'label' => 'Test Objective',
    ],
    [
        'name'  => 'steps',
        'type'  => 'textarea',
        'label' => 'Test Steps',
    ],
    [
        'name'  => 'data',
        'type'  => 'textarea',
        'label' => 'Test Data',
    ],
];

