<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * @author Jayesh
     *
     * @uses The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'full_name',
        'user_name',
        'lastname',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'town_of_birth',
        'country_of_birth',
        'state',
        'email_verified_at',
        'password',
        'types',
        'status',
        'address',
        'zipcode',
        'city',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @author Jayesh
     *
     * @uses The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        'full_name' => 'string',
        'user_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'email_verified_at' => 'string',
        'password' => 'string',
        'types' => 'string',
        'status' => 'string',
        'address' => 'string',
        'zipcode' => 'string',
        'city' => 'string',
        'remember_token' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string',
        'deleted_at' => 'string',
    ];

    /**
     * @author Jayesh
     *
     * @uses Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    // protected function password(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) =>  bcrypt($value),
    //     );
    // }


    /**
     * Get all of the product for the order product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasmany
     */
    public function orderproducts()
    {
        return $this->hasMany(Orderproduct::class);
    }
}