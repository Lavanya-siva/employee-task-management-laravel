<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{


protected $fillable = [

    'created_by',
    'assigned_to',
    'title',
    'description',
    'priority',
    'status',
    'due_date'

];





public function creator()
{

    return $this->belongsTo(
        User::class,
        'created_by'
    );

}





public function employee()
{

    return $this->belongsTo(
        User::class,
        'assigned_to'
    );

}



}