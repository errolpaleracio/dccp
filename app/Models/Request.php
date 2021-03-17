<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction as Trans;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'study', 'document', 'copies', 'price', 'transaction_id'
    ];

    public function Transaction(){
        return $this->belongsTo(Trans::class);
    }

    public function TotalAmount(){
        return $this->price * $this->copies;
    }
}
