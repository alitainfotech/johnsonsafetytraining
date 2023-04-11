<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avilabledate extends Model
{
    use HasFactory;
    public $table = "avilabledate";
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
        'start_at',
        'end_at',
        'no_of_seat',
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
        'start_at',
        'end_at',
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
        'start_at',
        'end_at',
        'status',
        'id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all of the product for the order product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasmany
     */
    public function getAvailable()
    {
        return $this->hasMany(Order::class,'available_id');
    }
}