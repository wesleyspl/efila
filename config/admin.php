<?php

return [


#### menu do side-bar do sistema 
    'menu' => [
        [
            'title' => 'Inicio',
            'icon' => 'icon-home-3',
            'url' => '#',
            'active' => ['home*'],
            'sub_menu' => [
                [
                    'title' => 'Dashboard',
                    'url' => '/',
                    'active' => ['/*'],
                ],
                
            ],
         
        ],
        
        [
            'title' => 'Paineis',
            'icon' => 'icon-window',
            'url' => '#',
            'active' => ['admin/dashboard*'],
            'sub_menu' => [
                [
                    'title' => 'Painel de Senha',
                    'url' => 'painel',
                    'active' => ['painel*'],
                ],
                [
                    'title' => 'Painel Touch',
                    'url' => 'touch',
                    'active' => ['touch*'],
                ],
            ],
        ],
       
        [
            'title' => 'Cadastros',
            'icon' => 'icon-folder-3',
            'url' => '#',
            'active' => ['admin/dashboard*'],
            'sub_menu' => [
                [
                    'title' => 'Serviços',
                    'url' => 'servico',
                    'active' => ['painel*'],
                ],
                [
                    'title' => 'local',
                    'url' => 'local',
                    'active' => ['local*'],
                ],
                [
                    'title' => 'Atendente',
                    'url' => 'atendente',
                    'active' => ['touch*'],
                ],
            ],
        ],
        [
            'title' => 'Triagem',
            'icon' => 'icon-clipboard-1',
            'url' => '#',
            'active' => ['local*'],
            'sub_menu' => [
                [
                    'title' => 'Configurar',
                    'url' => 'triagem',
                    'active' => ['touch*'],
                ],
                [
                    'title' => 'Tirar senha',
                    'url' => 'senha',
                    'active' => ['touch*'],
                ],
               
            ],
        ],   
       



    ],
];



?>