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
            'objective'       => 'required|min:5|max:255',
            'steps'           => 'required|min:5',
            'data'            => 'required|min:5',
            'expected_result' => 'required|min:5'
        ],
        'bulkUpdate' => [
            'release_version' => 'nullable|max:10',
            'is_regression'   => 'nullable',
        ]
    ]
];

