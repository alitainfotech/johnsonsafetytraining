<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
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
        'file_name',
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
        'product_id' => 'string',
        'file_name' => 'string',
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
    // public $searchable = [

    // ];

    /**
     * The attributes that should be selectable in datatable.
     *
     * @var array<string, string>
     */
    public $selectable = [

    ];

    /**
     * The attributes that should be orderable in datatable.
     *
     * @var array<string, string>
     */
    public $orderable = [

    ];

    public function getFileNameAttribute($value)
    {
        return url(asset('uploads/materials/' . $this->product_id . '/' . $value));
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
