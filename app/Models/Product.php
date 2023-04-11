<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'category_id',
        'name',
        'slug',
        'suburb',
        'tag',
        'description',
        'price',
        'start_at',
        'end_at',
        'status',
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
    protected $hidden = [];

    /**
     * @author Jayesh
     *
     * @uses The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'category_id' => 'string',
        'name' => 'string',
        'slug' => 'string',
        'suburb' => 'string',
        'tag' => 'string',
        'description' => 'string',
        'price' => 'string',
        'start_at' => 'string',
        'end_at' => 'string',
        'status' => 'string',
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
        'slug',
        // 'category.name',
        // 'description',
        'price',
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
        // 'slug',
        // 'category.name',
        // 'description',
        'price',
        'status',
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
        // 'slug',
        // 'description',
        'price',
        'status',
        'id',
    ];

    /**
     * @author Jayesh
     *
     * @uses Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the images for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get all of the images for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Get all of the avilabledates for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avilabledates()
    {
        return $this->hasMany(Avilabledate::class);
    }

    /**
     * Get all of the avilabledates for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderproduct()
    {
        return $this->hasMany(Orderproduct::class);
    }
}
