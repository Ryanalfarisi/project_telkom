<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $table = 'lembur';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'time_from', 'time_until','user_id',
        'description', 'status', 'approved_id',
        'duration', 'insert_date', 'location', 'job', 'job_name'
    ];
}
