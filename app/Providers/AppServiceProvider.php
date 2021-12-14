<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
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
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        view()->composer('pages._sidebar', function ($view){
           $view->with('popularPosts', Post::getPopularPosts());
           $view->with('featuredPosts', Post::getFeaturedPosts());
           $view->with('recentPosts', Post::getRecentPosts());
           $view->with('categories', Category::all());
        });
        view()->composer('admin.layout', function ($view){
            $view->with('newCommentsCount', Comment::newCommentsCount());
        });
    }
}
