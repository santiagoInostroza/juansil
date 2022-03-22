<div class="shadow border bg-gray-800 text-gray-400 p-4 h-full">
    @php
        $vistas =[
            [
                'name' => 'DASHBOARD',
                'icon' => 'fas fa-tachometer-alt',
                'route' => 'admin2.dashboard.index',
                'can' => 'admin.dashboard.index'
            ],
            // [
            //     'name' => 'Mi Info',
            //     'icon' => 'fas fa-tachometer-alt',
            //     'route' => 'admin',
            //     'can' => 'admin'
            // ],
            [
                'name' => 'USUARIOS',
                'icon' => 'fas fa-users',
                'route' => 'admin2.users.index',
                'can' => 'admin.users.index'
               
            ],
            [
                'name' => 'roles y permisos',
                'icon' => 'fas fa-users-cog',
                 'route' => 'admin2.roles.*',
                'can' => 'admin.roles.index',
                'child' =>
                    [
                        [
                            'name' => 'ROLES',
                            // 'icon' => 'fas fa-users-cog',
                            'route' => 'admin2.roles.index',
                            'can' => 'admin.roles.index'
                        ],

                        [
                            'name' => 'Permisos',
                            // 'icon' => 'fas fa-users-cog',
                            'route' => 'admin2.permissions.index',
                            'can' => 'admin.permissions.index'
                        ],
                    ],
            ],
            
            // [
            //     'name' => 'COMPRAS',
            //     'icon' => 'fas fa-file-invoice',
            //     'route' => 'admin.purchases.*',
            //     'can' => 'admin.purchases.index',
            //     'child' => [
            //         [
            //             'name' => 'LISTA DE COMPRAS',
            //             'icon' => 'fas fa-file-invoice',
            //             'route' => 'admin.purchases.index',
            //             'can' => 'admin.purchases.index'
            //         ],
            //         [
            //             'name' => 'CREAR COMPRA',
            //             'icon' => 'fas fa-file-invoice',
            //             'route' => 'admin.purchases.create',
            //             'can' => 'admin.purchases.create'
            //         ],
            //     ]
            // ],
        
            // [
            //     'name' => 'VENTAS',
            //     'icon' => 'fas fa-cash-register',
            //     'route' => 'admin.sales.*',
            //     'can' => 'admin.sales.index',
            //     'child' =>  
            //         [
            //             [
            //                 'name' => 'LISTA DE VENTAS',
            //                 // 'icon' => 'fas fa-cash-register',
            //                 'route' => 'admin.sales.index',
            //                 'can' => 'admin.sales.index'
            //             ],
            //             [
            //                 'name' => 'CREAR VENTA',
            //                 // 'icon' => 'fas fa-cash-register',
            //                 'route' => 'admin.sales.create',
            //                 'can' => 'admin.sales.create'
            //             ],
            //         ],
            // ],
            
            // [
            //     'name' => 'CATEGORIAS',
            //     'icon' => 'fas fa-cash-register',
            //     'route' => 'admin.categories.*',
            //     'can' => 'admin.categories.index',
            //     'child' =>  
            //     [
            //         [
            //             'name' => 'LISTA DE CATEGORIAS',
            //             // 'icon' => 'fas fa-cash-register',
            //             'route' => 'admin.categories.index',
            //             'can' => 'admin.categories.index'
            //         ],
            //         [
            //             'name' => 'CREAR CATEGORIA',
            //             // 'icon' => 'fas fa-cash-register',
            //             'route' => 'admin.categories.create',
            //             'can' => 'admin.categories.create'
            //         ],
            //     ]
            // ],

        
    
            // [
            //     'name' => 'PRODUCTOS',
            //     'icon' => 'fab fa-product-hunt',
            //     'route' => 'admin.products',
            //     'can' => 'admin.products'
            // ],
            [
                'name' => 'PROVEEDORES',
                'icon' => 'fas fa-truck-moving',
                'route' => 'admin2.suppliers.index',
                'can' => 'admin.suppliers.index'
            ],
            // [
            //     'name' => 'Clientes',
            //     'icon' => 'fas fa-user',
            //     'route' => 'admin.customers',
            //     'can' => 'admin.customers'
            // ],
        
        ];
    @endphp

    <div class="flex gap-2 items-center justify-between mb-8">
        <div class="p-2">
            {{auth()->user()->name}}
            <div class="text-xs text-gray-500">
                {{auth()->user()->roles()->first()->name}}
            </div>
        </div>
        <template  x-if="isMobile">
            <div x-on:click="isOpenAside = !isOpenAside" class="px-2 cursor-pointer hover:font-bold hover:text-gray-400 ">
                <i class="fas fa-arrow-left"></i>
            </div>
        </template>
    </div>
    
    @foreach ($vistas as $vista)
        @if (isset($vista['child']))
            <div x-data="{isOpen:false}" >
                <div x-on:click="isOpen = !isOpen" x-on:click.away="isOpen = false" class=" flex justify-between items-center gap-2 p-2 hover:text-white   w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif" :class=" isOpen ? 'font-bold bg-gray-800':'' "  >
                    <div class="flex items-center gap-2">
                        <div class="text-gray-300">
                            <i class="{{$vista['icon']}}"></i>
                        </div>
                        <h3>{{ Str::ucfirst(Str::lower($vista['name']))  }}</h3>    
                    </div>
                    <div>
                        <i x-cloak x-show="isOpen" class="fas fa-chevron-up" ></i>
                        <i x-cloak x-show="!isOpen" class="fas fa-chevron-down" ></i>
                    </div>
                </div>
                <div x-cloak x-show="isOpen" class=" w-full" x-transition>
                    
                    @foreach ( $vista['child'] as $key => $v )
                  
                        @if ( isset($v['can']) && $v['can'] != "")
                            @can($v['can'])
                                <a href="{{ route($v['route']) }}" class="bg-gray-800 flex items-center pl-8 gap-2 p-2 hover:text-white w-full cursor-pointer @if(request()->routeIs($v['route'])) bg-gray-800 text-red-500 font-bold hover:text-red-700 @endif">
                                    <h3 class="">{{ Str::ucfirst(Str::lower($v['name'])) }}</h3>
                                  
                                </a>
                            @endcan
                        @else
                            <a href="{{ route($v['route']) }}" class="bg-gray-800 flex items-center  pl-8 gap-2 p-4 hover:text-white w-full cursor-pointer @if(request()->routeIs($v['route'])) bg-gray-800 text-red-500 font-bold hover:text-red-700 @endif">
                                <h3 class="pl-6">{{ Str::ucfirst(Str::lower($v['name']))  }}</h3>
                            </a>
                        @endif
                    
                    
                    @endforeach   

                </div>
                
            </div>
        @else
            @if (isset($vista['can']) && $vista['can'] != "")
                @can($vista['can'])
                <a href="{{ route($vista['route']) }}" class="flex items-center gap-2 p-2 hover:text-white  w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif">
                    <div class="text-gray-400">
                        <i class="{{$vista['icon']}}"></i>
                    </div>
                    <h3>{{  Str::ucfirst(Str::lower($vista['name']))   }}</h3>
                
                </a>
                @endcan
            @else
                <a href="{{ route($vista['route']) }}" class="flex items-center gap-2 p-2 hover:text-white w-full cursor-pointer @if(request()->routeIs($vista['route'])) bg-gray-900 text-white @endif">
                    <div class="text-gray-400">
                        <i class="{{$vista['icon']}}"></i>
                    </div>
                    <h3>{{ Str::ucfirst(Str::lower($vista['name']))   }}</h3>
                </a>
            @endif
        @endif
    @endforeach  
</div>
