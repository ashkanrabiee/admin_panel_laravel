<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Content\Post;
use App\Models\Notification;
use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use App\Models\User\Role;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;
class AppServiceProvider extends ServiceProvider
{

    protected $policies = [

        Post::class => PostPolicy::class 

    ];
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
        // Auth::loginUsingId(12);
        // // dd(Auth::user()->roles);
        // $role = Role::find(3);
        // dd($role);

        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::where('seen', 0)->get());
            $view->with('notifications', Notification::where('read_at', null)->get());
        });


        view()->composer('customer.layouts.header', function ($view) {
            $cartItems = collect(); // مقدار پیش‌فرض یک کالکشن خالی
        
            if (Auth::check()) {
                $cartItems = CartItem::where('user_id', Auth::id())->get();
            }
        
            $view->with('cartItems', $cartItems);
        });

            //  Gate::define('update-post', function(User $user, Post $post) {
            //     return $user->id === $post->author_id;
            // });
            
            
            // Gate::define('update-post', function(User $user) {
            //         return $user->user_type === 1 ? Response::allow()
            //         : Response::deny('شما اجازه دسترسی ندارید');
            //         // : Response￼::denyWithStatus(404);
            //     });


        //     Gate::before(function($user, $ability){
        //     if($user->user_type === 1)
        //     {
        //         return true;
        //     }
        // });
            
            // Gate::after(function($user, $ability){
            //     if($user->user_type === 1)
            //     {
            //         return true;
            //     }
            // });



            Gate::define('update-post' , [PostPolicy::class , 'update']);







    }
}
