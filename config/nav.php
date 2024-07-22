<?php


return[
    [
        'icons'=>'nav-icon fas fa-tachometer-alt',
        'title'=>'Dashboard',
        'route'=>'dashboard',
        'active'=>'dashboard'
    ],
    [
        'icons'=>'nav-icon fas fa-tachometer-altfar fa-circle nav-icon',
        'title'=>'Categories',
        'route'=>'categories.index',
        'badge'=>'New',
        'active'=>'categories.*',
        'ability'=>'categories.view'

    ],
    [
        'icons'=>'nav-icon fas fa-tachometer-altfar fa-circle nav-icon',
        'title'=>'Products',
        'route'=>'products.index',
        'badge'=>'New',
        'active'=>'products.*',
        'ability'=>'products.view'

    ],
    [
        'icons'=>'nav-icon fas fa-tachometer-altfar fa-circle nav-icon',
        'title'=>'Orders',
        'route'=>'categories.index',
        'active'=>'orders.*',
        'ability'=>'orders.view'

    ],
    [
        'icons'=>'nav-icon fas fa-shield nav-icon',
        'title'=>'Roles',
        'route'=>'roles.index',
        'active'=>'roles.*',
        'ability'=>'roles.view'


    ],


];

