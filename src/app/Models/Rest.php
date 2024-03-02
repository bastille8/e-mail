<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stamp;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = [
        'rests_id',
        'rest_in',
        'rest_out',
        'rest_time',
    ];

    public function stamp()
    {
        return $this->belongsTo('App\Models\Stamp');
    }
}
