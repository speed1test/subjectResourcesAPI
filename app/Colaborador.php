<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
   protected $table = 'colaboradores';

   protected $fillable = [
       'id','nombre', 'contacto'
   ];
}
