<?php
namespace Student;

use Zend\Router\Http\Segment;
use Student\Controller\StudentController;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'student' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/student[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\StudentController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'student' => __DIR__ . '/../view',
        ],
    ],
];