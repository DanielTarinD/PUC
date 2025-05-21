<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
    'Administrador' => [
            [
                'icon' => 'fas fa-house',
                'title' => 'Inicio',
                'label' => '',
                'url' => '/',
                'route-name' => 'inicio'
            ],
            [
                'icon' => 'fas fa-clipboard-list',
                'title' => 'Preregistros',
                'label' => '',
                'url' => '/preregistros',
                'route-name' => 'preregistros.index'
            ],
            [
                'icon' => 'fas fa-building',
                'title' => 'Empresas',
                'label' => '',
                'url' => '/administracion/empresas',
                'route-name' => 'empresas.index'
            ],
            [
                'icon' => 'fas fa-arrows-rotate',
                'title' => 'Refrendos',
                'label' => '',
                'url' => '/administracion/refrendos',
                'route-name' => 'administracion.refrendos.index'
            ],

        ],
    'Revisor' => [
            [
                'icon' => 'fas fa-building',
                'title' => 'Inscripciones',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/revisor',
                        'title' => 'Nuevas',
                        'route-name' => 'revisor.index'
                    ],[
                        'url' => '/revisor/seguimiento',
                        'title' => 'Seguimiento',
                        'route-name' => 'revisor.seguimiento.index'
                    ]
                ]
            ],
            [
                'icon' => 'fas fa-arrows-rotate',
                'title' => 'Refrendos',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/revisor/refrendos',
                        'title' => 'Nuevos',
                        'route-name' => 'revisor.refrendos.index'
                    ],[
                        'url' => '/revisor/refrendos/seguimiento',
                        'title' => 'Seguimiento',
                        'route-name' => 'revisor.refrendos.seguimiento.index'
                    ]
                ]
            ],
        ],
    'Contralor' => [
            [
                'icon' => 'fas fa-building',
                'title' => 'Inicio',
                'label' => '',
                'url' => '/contralor',
                'route-name' => 'contralor.index'
            ], [
                'icon' => 'fas fa-arrows-rotate',
                'title' => 'Refrendos',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/contralor/refrendos',
                        'title' => 'Nuevos',
                        'route-name' => 'contralor.refrendos.index'
                    ],[
                        'url' => '/contralor/refrendos/seguimiento',
                        'title' => 'Seguimiento',
                        'route-name' => 'contralor.refrendos.seguimiento.index'
                    ]
                ]
            ],
        ],
    'Supervisor' => [
            [
                'icon' => 'fas fa-house',
                'title' => 'Inicio',
                'label' => '',
                'url' => '/',
                'route-name' => 'inicio'
            ],
            [
                'icon' => 'fas fa-building',
                'title' => 'Empresas',
                'label' => '',
                'url' => '/supervision/empresas',
                'route-name' => 'supervision.index'
            ],
            [
                'icon' => 'fas fa-arrows-rotate',
                'title' => 'Refrendos',
                'label' => '',
                'url' => '/supervision/refrendos',
                'route-name' => 'supervision.index.refrendos'
            ],
        ],
    'Jefatura' => [
            [
                'icon' => 'fas fa-house',
                'title' => 'Inicio',
                'label' => '',
                'url' => '/',
                'route-name' => 'inicio'
            ],
            [
                'icon' => 'fas fa-building',
                'title' => 'Empresas',
                'label' => '',
                'url' => '/jefatura/empresas',
                'route-name' => 'jefatura.index'
            ],
            [
                'icon' => 'fas fa-arrows-rotate',
                'title' => 'Refrendos',
                'label' => '',
                'url' => '/jefatura/refrendos',
                'route-name' => 'jefatura.refrendos.index'
            ],

        ],
    'Contratista' => [
            [
                'icon' => 'fas fa-house',
                'title' => 'Inicio',
                'label' => '',
                'url' => '/',
                'route-name' => 'inicio'
            ],[
                'icon' => 'fas fa-building',
                'title' => 'Empresa',
                'url' => 'javascript:;',
                'caret' => true,
                'sub_menu' => [
                    [
                        'url' => '/empresa/gral',
                        'title' => 'Información General',
                        'route-name' => 'empresa.general'
                    ],[
                        'url' => '/empresa/legal',
                        'title' => 'Información Legal',
                        'route-name' => 'empresa.legal'
                    ],[
                        'url' => '/empresa/representante',
                        'title' => 'Representante Legal',
                        'route-name' => 'empresa.representante'
                    ],[
                        'url' => '/empresa/socios',
                        'title' => 'Socios',
                        'route-name' => 'empresa.socios'
                    ],[
                        'url' => '/empresa/especialidades',
                        'title' => 'Especialidades',
                        'route-name' => 'empresa.especialidades'
                    ],[
                        'url' => '/empresa/contable',
                        'title' => 'Información Contable',
                        'route-name' => 'empresa.contable'
                    ],[
                        'url' => '/empresa/tecnica',
                        'title' => 'Información Técnica',
                        'route-name' => 'empresa.tecnica'
                    ]
                ]
            ],
        ]
];
