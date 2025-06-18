<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMerk extends Model
{
    use HasFactory;

    protected $table = 'master_merks';
    protected $guarded = ['id'];
}
