<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class member extends Model
{
    use HasFactory;
    public $table = 'member';
    protected $primarykey = 'id';
    
    public function group()
    {
       return $this->hasOne('App\Models\group', 'group_id' , 'group_id'); // one to one relation
    }
   
}
