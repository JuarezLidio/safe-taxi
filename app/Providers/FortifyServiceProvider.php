<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use App\Services\TreeBuilderService;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TreeBuilderService::class, function ($app) {
            return new TreeBuilderService();
        });

        $this->app->instance(LoginResponse::class, new class($this->app->make(TreeBuilderService::class)) implements LoginResponse {
            private $treeBuilderService;

            public function __construct(TreeBuilderService $treeBuilderService)
            {
                $this->treeBuilderService = $treeBuilderService;
            }

            public function toResponse($request)
            {
                $userRole = Role::where('id', Auth::user()->id_role)->first();
                $userRoleMenu = $userRole->menus()->get();
                return session(['menu' => $this->treeBuilderService->buildTree($userRoleMenu->toArray())]);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Register the Attempting listener to check if user is active
        Event::listen('Illuminate\Auth\Events\Attempting', function ($event) {
            $user = User::where('email', $event->credentials['email'])->first();

            if ($user && $user->is_active == 0) {
                throw ValidationException::withMessages([
                    Fortify::username() => [trans('auth.failed')],
                ]);
            }
        });
    }
}
