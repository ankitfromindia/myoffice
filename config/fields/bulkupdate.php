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
    ],
    [
        'name'              => 'module_id',
        'type'              => 'select2_from_ajax',
        'label'             => 'Module Name',
        'entity'            => 'module', // the method that defines the relationship in your Model
        'attribute'         => 'name', // foreign key attribute that is shown to user
        'model'             => "App\Models\Module",
        'data_source'       =>  '' ,//url('/admin/module/getMyModules'),
        'placeholder' => '',
        'minimum_input_length' => 2
    ],
    [
        'name'       => 'is_regression',
        'type'       => 'checkbox',
        'label'      => 'Is Regression?',
    ],
    [
        'name'   => 'release_version',
        'type'   => 'text',
        'label'  => 'Release/Fix Version',
        'prefix' => 'v',
    ],
];

