<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @author Jayesh
     * 
     * @uses The attributes that are mass assignable.
     *  
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    /**
     * @author Jayesh
     * 
     * @uses The attributes that should be hidden for serialization.
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * @author Jayesh
     * 
     * @uses The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'slug' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string',
    ];

    /**
     * @author Jayesh
     * 
     * @uses The attributes that should be searchable in datatable.
     * 
     * @var array<string, string>
     */
    public $searchable = [
        'name', 
        'slug'
    ];

    /**
     * @author Jayesh
     * 
     * @uses The attributes that should be selectable in datatable.
     *
     * @var array<string, string>
     */
    public $selectable = [
        'id', 
        'name', 
        'slug',
    ];

    /**
     * @author Jayesh
     * 
     * @uses The attributes that should be orderable in datatable.
     *
     * @var array<string, string>
     */
    public $orderable = [
        'id', 
        'name', 
        'slug', 
        'id', 
    ];

    /**
     * @author Jayesh
     * 
     * @uses Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
