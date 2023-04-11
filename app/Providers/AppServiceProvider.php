<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        Builder::macro('whereLike', function ($attributes, $search) {
            if(!is_null($search)) {
                $this->where(function (Builder $query) use ($attributes, $search) {
                    foreach (Arr::wrap($attributes) as $attribute) {
                        $query->when(Str::contains($attribute, '.'), function (Builder $query) use ($attribute, $search) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $search) {
                                $query->where($relationAttribute, 'LIKE', "%{$search}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $search) {
                            $query->orWhere($attribute, 'LIKE', "%{$search}%");
                        });
                    }
                });
            }
            return $this;
        });
    }
}
