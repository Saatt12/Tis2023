<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       // dd('asdnkasn');
        View::composer('*', function ($view) {
            $user_permission = [];
            if (Auth::check()) {
                // Assuming your user model has a `roles` relationship
                $permissions_id = RolePermission::where('rol_id',Auth::user()->rol_id)->pluck('permission_id');
                $user_permission = Permission::whereIn('id',$permissions_id)->pluck('key');
            }
            $view->with('user_permission', $user_permission);
        });
    }
}
