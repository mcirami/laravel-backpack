<?php

return [

    /*
    | Backpack/PermissionManager configs.
    */

    /*
    |--------------------------------------------------------------------------
    | User Fully-Qualified Class Name
    |--------------------------------------------------------------------------
    |
    */
    'user_model' => 'App\User',

    /*
    |--------------------------------------------------------------------------
    | Disallow the user interface for creating/updating permissions or roles.
    |--------------------------------------------------------------------------
    | Roles and permissions are used in code by their name
    | - ex: $user->hasPermissionTo('edit articles');
    |
    | So after the developer has entered all permissions and roles, the administrator should either:
    | - not have access to the panels
    | or
    | - creating and updating should be disabled
    */

    'allow_user_create'       => env('ALLOW_USER_CREATE', true),
    'allow_user_update'       => env('ALLOW_USER_UPDATE', true),
    'allow_user_delete'       => env('ALLOW_USER_DELETE', true),
    'allow_permission_create' => env('ALLOW_PERMISSION_CREATE', true),
    'allow_permission_update' => env('ALLOW_PERMISSION_UPDATE', true),
    'allow_permission_delete' => env('ALLOW_PERMISSION_DELETE', true),
    'allow_role_create'       => env('ALLOW_ROLE_CREATE', true),
    'allow_role_update'       => env('ALLOW_ROLE_UPDATE', true),
    'allow_role_delete'       => env('ALLOW_ROLE_DELETE', true),

];
