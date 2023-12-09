<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_uid', 'user_id', 'license_plates'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function histories(){
        return $this->hasMany(History::class);
    }
}
