<?php

return [



    'menu' => [
        [
            'title' => 'Home',
            'icon' => 'fa-dashboard',
            'url' => '/',
            'active' => ['home*'],
         
        ],
        
        [
            'title' => 'Paineis',
            'icon' => 'fa-dashboard',
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
        // Adicione mais itens de menu conforme necessário
        [
            'title' => 'Triagem',
            'icon' => 'fa-dashboard',
            'url' => '#',
            'active' => ['local*'],
            'sub_menu' => [
                [
                    'title' => 'Atendente',
                    'url' => 'atendente',
                    'active' => ['touch*'],
                ],
                [
                    'title' => 'Serviços',
                    'url' => 'servico',
                    'active' => ['touch*'],
                ],
                [
                    'title' => 'local',
                    'url' => 'local',
                    'active' => ['local*'],
                ],
               
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