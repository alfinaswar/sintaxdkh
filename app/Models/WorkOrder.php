<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $table = 'work_orders';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the WorkOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getDitugaskanOleh()
    {
        return $this->belongsTo(User::class, 'DitugaskanOleh', 'id');
    }
    public function getDitugaskanKe()
    {
        return $this->belongsTo(User::class, 'DitugaskanKe', 'id');
    }
    public function getDepartemen()
    {
        return $this->belongsTo(MasterDepartemen::class, 'Departemen', 'id');
    }
    public function getUnit()
    {
        return $this->belongsTo(MasterUnit::class, 'Unit', 'id');
    }
}
