<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class MasterRs extends Model
{
    use HasFactory;
    protected $table = 'master_rs';
    protected $guarded = ['id'];


    public function getKota()
    {
        return $this->belongsTo(City::class, 'Kota', 'id');
    }
    public function getKecamatan()
    {
        return $this->belongsTo(District::class, 'Kecamatan', 'id');
    }
}
