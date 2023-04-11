<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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
        'companyname',
        'order_id',
        'taxid',
        'companyaddress',
        'companyzipcode',
        'companycity',
        'companystate',
        'companycountry',
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
        'companyname' => 'string',
        'taxid' => 'string',
        'companyaddress' => 'string',
        'companyzipcode ' => 'string',
        'companycity' => 'string',
        'companystate' => 'string',
        'companycountry' => 'string',
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
}
