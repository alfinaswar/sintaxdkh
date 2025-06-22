<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use HasFactory;

    protected $table = 'Pm';
    protected $guarded = ['id'];

    public function getDikerjakanOleh()
    {
        return $this->belongsTo(User::class, 'DikerjakanOleh', 'id');
    }
}
