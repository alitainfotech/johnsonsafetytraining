<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderproduct extends Model
{
    use HasFactory;

    /**
     * @author Jayesh
     *
     * @uses The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = "order_products";
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'user_id',
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
        'order_id' => 'string',
        'product_id' => 'string',
        'user_id' => 'string',
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
    // public $searchable = [

    // ];

    /**
     * The attributes that should be selectable in datatable.
     *
     * @var array<string, string>
     */
    public $selectable = [];

    /**
     * The attributes that should be orderable in datatable.
     *
     * @var array<string, string>
     */
    public $orderable = [];

    /**
     * Get all of the product for the order product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongto
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all of the product for the order product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongto
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get all of the product for the order product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongto
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
