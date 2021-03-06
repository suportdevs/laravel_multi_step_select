<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devision extends Model
{
    use HasFactory;

    protected $fillable = [
        'devisions_name'
    ];

    public function devision()
    {
        return $this->belongsToMany(District::class);
    }
}
