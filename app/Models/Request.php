<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'study', 'document', 'copies', 'price', 'remarks', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function TotalAmount(){
        return $this->price * $this->copies;
    }
}
