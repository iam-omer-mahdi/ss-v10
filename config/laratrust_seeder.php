<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'User' => 'c,r,u,d',
            'Student' => 'c,r,u,d',
            'Classroom' => 'c,r,u,d',
            'Grade' => 'c,r,u,d',
            'School' => 'c,r,u,d',
            'Fee' => 'c,r,u,d',
            'Discount' => 'c,r,u,d',
            'GradFee' => 'c,r,u,d',
            'Result' => 'c,r,u,d',
            'Exam' => 'c,r,u,d',
            'Mark' => 'c,r,u,d',
            'Subject' => 'c,r,u,d',
            'Role' => 'c,r,u,d',
            'Permission' => 'c,r,u,d',
        ],
        'finance_manager' => [
            'User' => 'c,r,u,d',
            'Student' => 'c,r,u,d',
            'Classroom' => 'c,r,u,d',
            'Grade' => 'c,r,u,d',
            'School' => 'c,r,u,d',
            'Fee' => 'c,r,u,d',
            'Discount' => 'c,r,u,d',
            'GradFee' => 'c,r,u,d',
            'Result' => 'r',
            'Exam' => 'r',
            'Mark' => 'r',
            'Subject' => 'r',
            'Role' => 'c,r,u,d',
            'Permission' => 'c,r,u,d',
        ],
        'accountant' => [            
            'Student' => 'c,r,u',
            'Classroom' => 'r',
            'Grade' => 'r',
            'School' => 'r',
            'Fee' => 'c,r,u',
            'Discount' => 'r',
            'GradFee' => 'r',
        ],
        'results_manager' => [
            'Student' => 'r',
            'Classroom' => 'r',
            'Grade' => 'r',
            'School' => 'r',
            'Result' => 'c,r,u,d',
            'Exam' => 'c,r,u,d',
            'Mark' => 'c,r,u,d',
            'Subject' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
