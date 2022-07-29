<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('guru', function (User $user) {
            return $user->role === 'guru';
        });
        Gate::define('siswa', function (User $user) {
            return $user->role === 'siswa';
        });
        Gate::define('wali-kelas', function (User $user) {
            return $user->role === 'wali-kelas';
        });
    }
}
