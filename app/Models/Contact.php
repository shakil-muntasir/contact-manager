<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['birthdate'];

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = Carbon::parse($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
