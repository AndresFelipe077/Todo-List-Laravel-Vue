<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getImageAttribute()
    {
        $column = 'image';

        if (isset($this->attributes[$column]) && isset($this->attributes[$column][0])) {
            return url('storage/' . $this->attributes[$column]);
        }
        return null;
    }

    public function setCreatedAtAttribute($value)
    {
        date_default_timezone_set("America/Bogota");
        $this->attributes['created_at'] = Carbon::now();
    }

    public function setUpdatedAtAttribute($value)
    {
        date_default_timezone_set("America/Bogota");
        $this->attributes['updated_at'] = Carbon::now();
    }
}
