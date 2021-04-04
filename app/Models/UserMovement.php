<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMovement extends Model
{
    use HasFactory;

    protected $table = "user_movements";

    protected $fillable = [
        "id_user",
        "value",
        "type",
        "reversed"
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


}
