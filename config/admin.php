<?php

return [

  'title'=>'Efila | ',
  'link_site'=>'https://cerradoclound.com.br',

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
                    'icon' => 'fa fa-solid fa-tv',
                ],
                
            ],
         
        ],
        
        [
            'title' => 'Paineis',
            'icon' => 'fa fa-solid fa-tv',
            'url' => '/painel',
            'active' => ['/painel*'],
            'sub_menu' => [
                [
                    'title' => 'Painel de Senha',
                    'url' => '/painel',
                    'active' => ['/painel*'],
                    'icon' => 'fa fa-solid fa-tv',

                ],
                [
                    'title' => 'Auto Atendimento',
                    'url' => 'touch',
                    'active' => ['touch*'],
                    'icon' => 'fas fa-ticket-alt',
                ],
            ],
        ],
       
        [
            'title' => 'Cadastros',
            'icon' => 'fa fa-solid fa-folder-open',
            'url' => '#',
            'active' => ['sevico*'],
            'sub_menu' => [
                [
                    'title' => 'Serviços',
                    'url' => 'servico',
                    'active' => ['painel*'],
                    'icon' => 'fas fa-wrench',
                ],
                [
                    'title' => 'local de atendimento',
                    'url' => 'local',
                    'active' => ['local*'],
                    'icon' => 'fas fa-home',
                ],
                [
                    'title' => 'Atendente',
                    'url' => 'atendente',
                    'active' => ['touch*'],
                    'icon' => 'fas fa-users',
                ],
            ],
        ],
        [
            'title' => 'Triagem',
            'icon' => 'fas fa-list-alt',
            'url' => '#',
            'active' => ['local*'],
            'sub_menu' => [
                [
                    'title' => 'Configurar',
                    'url' => 'triagem',
                    'active' => ['touch*'],
                    'icon' => 'bi bi-card-checklist fas fa-cogs',
                ],
               
               
            ],
        ],  
        [
            'title' => 'Emitir senha',
            'url' => 'senha',
            'active' => ['touch*'],
            'icon' => 'fas fa-ticket-alt',
        ], 
       



    ],
];



?>