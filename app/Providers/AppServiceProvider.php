<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use App\Policies\categoryPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('delete-category', function (User $user, Category $cat) {
        return $user->id === $cat->created_by || $user->role=='admin';
    });

    Gate::define('create-product', function (User $user) {
        return $user->role=='manager' || $user->role=='admin';
    });

    //category policy
     Gate::policy(Category::class, categoryPolicy::class);
    }
}
