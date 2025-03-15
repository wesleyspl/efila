<?php

return [

  'title'=>'Efila | ',
#### menu do side-bar do sistema 
    'menu' => [
        [
            'title' => 'Inicio',
            'icon' => 'fas fa-tachometer-alt',
            'url' => '/',
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
            'icon' => 'fa fa-solid fa-tv',
            'url' => '#',
            'active' => ['/painel*'],
            'sub_menu' => [
                [
                    'title' => 'Painel de Senha',
                    'url' => 'painel',
                    'active' => ['/painel*'],
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
            'icon' => 'fa fa-solid fa-folder-open',
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
            'icon' => 'fa fa-solid fa-code-branch',
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