<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugable {
    /**
     * @author Jayesh
     * 
     * @uses Convert $name to unique slug
     * 
     * @param  mixed $model
     * @param  mixed $name
     * @param  mixed $id
     * @return void
     */
    public function createSlug($model, $name, $id = 0) {
        $is_exists = ($id == 0) 
                        ? $model::whereSlug($slug = Str::slug($name))->exists() 
                        : $model::whereSlug($slug = Str::slug($name))->where('id', '!=', $id)->exists();

        if ($is_exists) {
            $max = $model::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}