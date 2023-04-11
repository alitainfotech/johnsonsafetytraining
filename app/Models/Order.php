<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        'user_id',
        'available_id',
        'payment_id',
        'total',
        'address',
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
        'user_id' => 'string',
        'payment_id' => 'string',
        'total' => 'string',
        'address' => 'string',
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
     * @return \Illuminate\Database\Eloquent\Relations\hasmany
     */
    public function orderproducts()
    {
        return $this->hasMany(Orderproduct::class);
    }
    
    /**
     * Get all of the available records
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasmany
     */
    public function getAvailableDate()
    {
        return $this->belongsTo(Avilabledate::class,'available_id');
    }

    /**
     * Get all of the available records from enrolment
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasmany
     */
    public function getEnrolment()
    {
        return $this->belongsTo(UserEnrolment::class,'id','order_id');
    }
}