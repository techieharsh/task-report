<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'manager_id'
    ];

    // Association manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
