<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function clientDetail() {
        return $this->belongsTo(UserDetail::class, 'client_id', 'user_id');
    }

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    
    public static function getUserDetail($id){
        $detail  = UserDetail::where('user_id',$id)->first();
        return $detail;
    }
}
