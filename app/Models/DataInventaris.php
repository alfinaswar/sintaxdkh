<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInventaris extends Model
{
    use HasFactory;

    protected $table = 'data_inventaris';
    protected $guarded = ['id'];

    public function getDepartemen()
    {
        return $this->belongsTo(MasterDepartemen::class, 'Departemen', 'id');
    }

    public function getUnit()
    {
        return $this->belongsTo(MasterUnit::class, 'Unit', 'id');
    }

    public function getMerk()
    {
        return $this->belongsTo(MasterMerk::class, 'Merk', 'id');
    }
    public function getRS()
    {
        return $this->belongsTo(MasterRs::class, 'KodeRS', 'id');
    }

    public function getItem()
    {
        return $this->belongsTo(MasterItem::class, 'ItemID', 'id');
    }

    public function getWo()
    {
        return $this->hasMany(WorkOrder::class, 'ItemID', 'ItemID');
    }

    public function getPm()
    {
        return $this->hasMany(Pm::class, 'ItemID', 'ItemID');
    }
    public function getKalibrasi()
    {
        return $this->hasMany(Kalibrasi::class, 'ItemID', 'ItemID');
    }

}
