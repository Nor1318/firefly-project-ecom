<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
          'status'
     ];
     use HasFactory;
     public function user()
     {
          return $this->belongsTo(User::class);
     }
     public function address()
     {
          return $this->belongsTo(Address::class);
     }
}
