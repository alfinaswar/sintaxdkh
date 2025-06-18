<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDepartemen extends Model
{
    use HasFactory;

    protected $table = 'master_departemens';
    protected $guarded = ['id'];


    public function getUnit()
    {
        return $this->hasMany(MasterUnit::class, 'IdDepartemen', 'id');
    }
}
