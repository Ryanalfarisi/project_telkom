<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $table = 'lembur';
    protected $primaryKey = 'id';

    protected $fillable = [
        'entry_by', 'time_from', 'time_until', 'description', 'status', 'approved_by'
    ];
}
