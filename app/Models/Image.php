<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
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
        'product_id',
        'path',
        'title',
        'type',
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
        'product_id' => 'string',
        'path' => 'string',
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
        'path',
        'slug'
    ];

    /**
     * The attributes that should be selectable in datatable.
     *
     * @var array<string, string>
     */
    public $selectable = [
        'id',
        'path',
        'title',
        'type',
    ];

    /**
     * The attributes that should be orderable in datatable.
     *
     * @var array<string, string>
     */
    public $orderable = [
        'id',
        'path',
        'title',
        'type',
        'id',
    ];

    public function getPathAttribute($value)
    {

        return url(asset('uploads/products/' . $this->product_id . '/' . $value));
    }

    /**
     * Get the product that owns the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', '=', $type)->first();
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    // protected function path()
    // {
    //     return Attribute::make(
    //         get: fn ($value) => url(storage_path('public/' . $value)),
    //     );
    // }
}
