<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    use HasFactory;
    protected $table = 'master_items';
    protected $guarded = ['id'];

    /**
     * Get the getRs associated with the MasterItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRs()
    {
        return $this->hasOne(MasterRs::class, 'id', 'KodeRS');
    }
}
