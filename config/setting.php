<?php

return [
    'jira_id_prefix'         => 'AUGMENTO-',
    'release_version_prefix' => 'v',
    'validation'             => [
        'testcase' => [
            'jira_id'         => 'required',
            'release_version' => 'required|max:10',
            'is_regression'   => 'nullable',
            'module_id'       => 'required',
            'objective'       => 'required|min:5',
            'steps'           => 'required',
            'data'            => 'required',
            'expected_result' => 'required'
        ],
        'testcase_importable' => [
            'module_id'       => 'required',
            'objective'       => 'required|min:5',
            'steps'           => 'required',
            'data'            => 'required',
            'expected_result' => 'required'
        ],
        'bulkUpdate' => [
            'release_version' => 'nullable|max:10',
            'is_regression'   => 'nullable',
        ]
    ]
];

