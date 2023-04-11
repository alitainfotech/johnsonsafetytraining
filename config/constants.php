<?php

return [
    'prefix' => 'admin',

    'users' => [
        'status' => ['0', '1'],
        'status_text' => ['Inactive', 'Active']
    ],

    'products' => [
        'status' => ['0', '1'],
        'status_text' => ['Inactive', 'Active']
    ],

    'images' => [
        'type' => ['0', '1'],
        'type_text' => ['Secondary', 'Primary']
    ],

    'calendars' => [
        'type' => ['0', '1', '2', '3'],
        'type_text' => ['User', 'Course', 'Category', 'Site'],
        'duration_type' => ['0', '1', '2'],
        'duration_type_text' => ['Without Duration', 'Unitil', 'Duration In Minute'],
        'is_repeat' => ['0', '1'],
        'is_repeat_text' => ['No', 'Yes'],
        'status' => ['0', '1'],
        'status_text' => ['Unavailable', 'Available']
    ]
];