<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>Precios</b>deFeria',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => false,
            'topnav' => false,
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Dashboard',
            'route'         => 'admin.home',
            //'url'         => 'admin',
            'icon'        => 'fas fa-fw fa-tachometer-alt',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Usuarios',
            'route'         => 'admin.users.index',
            //'url'         => 'admin',
            'icon'        => 'fas fa-fw fa-users ',
            // 'label'       => 4,
            // 'label_color' => 'success',
            'can'  => 'admin.users.index',
        ],
        [
            'text'        => 'Lista de roles',
            'route'         => 'admin.roles.index',
            //'url'         => 'admin',
            'icon'        => 'fas fa-fw fa-users-cog ',
            // 'label'       => 4,
            // 'label_color' => 'success',
            'can'  => 'admin.users.index',
        ],
        ['header' => 'Administrador'],
        [
            'text' => 'Categorias',
            'route'  => 'admin.categories.index',
            // 'url'  => 'admin/settings',
            'icon' => 'fab fa-fw fa-buffer',
            'active'=> ['admin/categorias*']
        ],
        [
            'text' => 'Etiquetas',
            'route'  => 'admin.tags.index',
            // 'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-tags',
            'active' => ['admin/etiquetas*']
        ],
        [
            'text' => 'Marcas',
            'route'  => 'admin.brands.index',
            // 'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-copyright',
            'active'=> ['admin/marcas*']
        ],
        [
            'text' => 'Proveedores',
            'route'  => 'admin.suppliers.index',
            // 'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-copyright',
            'active'=> ['admin/proveedores*']
        ],
        [
            'text' => 'Clientes',
            'route'  => 'admin.customers.index',
            // 'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-users',
            'active'=> ['admin/clientes*']
        ],
        [
            'text'       => 'Comunas',
            'route'=> 'admin.comunas.index',
            'icon' => 'fas fa-fw fa-truck',
            'active'=> ['admin/comunas*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        ['header' => 'OPCIONES'],
        [
            'text'       => 'Productos',
            'route'=> 'admin.products.index',
            'icon' => 'fas fa-fw fa-clipboard',
            'active'=> ['admin/productos*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],
        [
            'text'       => 'Compras',
            'route'=> 'admin.purchases.index',
            'icon' => 'fas fa-fw fa-clipboard',
            'active'=> ['admin/compras*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],

        [
            'text'       => 'Ventas',
            'route'=> 'admin.sales.index',
            'icon' => 'fas fa-fw fa-cash-register',
            'active'=> ['admin/ventas*'],
            
        ],
        [
            'text'       => 'Deliveries',
            'route'=> 'admin.deliveries.index',
            'icon' => 'fas fa-fw fa-truck',
            'active'=> ['admin/deliveries*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],
       
      
       /* [
            'text'       => 'Crear nuevo producto',
            'route'=> 'admin.products.create',
            'icon' => 'fas fa-fw fa-file',
            'active'=> ['admin/productos/create']
           //'icon_color' => 'yellow',
           // 'url'        => '#',
        ],*/
        /*[
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],*/
        ['header' => 'INFO'],
        [
            'text'       => 'Movimiento Productos',
            'route'=> 'admin.movements.index',
            'icon' => 'fas fa-fw fa-clipboard',
            'active'=> ['admin/movimientos*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],
        [
            'text'       => 'Stock',
            'route'=> 'admin.stock.index',
            'icon' => 'fas fa-fw fa-clipboard',
            'active'=> ['admin/stock*']
            //'icon_color' => 'red',
            //'url'        => '#',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],



     /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => true,

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                    //'location' => '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                   // 'location' => '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                ],
                //agregado por mi
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css



                    ',
                  
                ],
               
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@10',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],


        //AGREGADOSS POR MI
        'Alpine' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js',  
                ],
            ],
        ],
        'ckEditor' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' =>  '//cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js',  
                ],
            ],
        ],
        'miJs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => app()->runningInConsole() ? '' :  asset('js/js.js') ,  
                ],
            ],
        ],
        'miCss' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => app()->runningInConsole() ? '' :  asset('css/css.css') ,  
                ],
            ],
        ],
        'StringToSlug' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' =>  app()->runningInConsole() ? '' :  asset('vendor\jQuery-Plugin-stringToSlug-1.3\jquery.stringToSlug.min.js'),  
                ],
            ],
        ],
        

    ],

   
];
