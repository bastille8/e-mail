<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Rest;


class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'stamps_id',
        'stamps_day',
        'work_in',
        'work_out',
        'work_time',
        'rests_time',
    ];

    public function down()
    {
        Schema::dropIfExists('stamps');
    }

    public function user()
    {
        // Stampモデルのstamps_id(外部キー)を第二引数として紐づける
        return $this->belongsTo(User::class, 'stamps_id');
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

}
