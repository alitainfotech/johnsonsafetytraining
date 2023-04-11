<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $appends = ['type_text', 'duration_type_text', 'is_repeat_text', 'status_text'];

    /**
     * @author Jayesh
     * 
     * @uses Interact with the Calendar's type.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getTypeTextAttribute()
    {
        return config('constants.calendars.type_text.' . $this->type);
    }

    /**
     * @author Jayesh
     * 
     * @uses Interact with the Calendar's duration_type.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getDurationTypeTextAttribute()
    {
        return config('constants.calendars.duration_type_text.' . $this->duration_type);
    }

    /**
     * @author Jayesh
     * 
     * @uses Interact with the Calendar's is_repeat.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getIsRepeatTextAttribute()
    {
        return config('constants.calendars.is_repeat_text.' . $this->is_repeat);
    }

    /**
     * @author Jayesh
     * 
     * @uses Interact with the Calendar's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function getStatusTextAttribute()
    {
        return config('constants.calendars.status_text.' . $this->status);
    }

    /**
     * @author Jayesh
     * 
     * @uses The attributes that are mass assignable.
     *  
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'type_id',
        'title',
        'description',
        'location',
        'start_at',
        'duration_type',
        'end_at',
        'duration_in_minute',
        'is_repeat',
        'repeat_times',
        'type',
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
        'type_id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'location' => 'string',
        'start_at' => 'string',
        'duration_type' => 'string',
        'end_at' => 'string',
        'duration_in_minute' => 'string',
        'is_repeat' => 'string',
        'repeat_times' => 'string',
        'type' => 'string',
        'status' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string',
    ];
}
