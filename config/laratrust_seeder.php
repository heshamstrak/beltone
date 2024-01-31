<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles'         => 'c,r,u,d',
            'admins'        => 'c,r,u,d',
            'users'         => 'c,r,u,d',
            'blogs'         => 'c,r,u,d',
            'slides'        => 'c,r,u,d',
            'abouts'        => 'c,r,u,d',
            'categories'    => 'c,r,u,d',
            'presses'       => 'c,r,u,d',
            'careers'       => 'c,r,u,d',
            'teams'         => 'c,r,u,d',
            'pages'         => 'c,r,u,d',
            'itemms'        => 'c,r,u,d',
            'services'      => 'c,r,u,d',
            'products'      => 'c,r,u,d',
            'businesses'    => 'c,r,u,d',
            'investors'     => 'c,r,u,d',
            'settings'      => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
