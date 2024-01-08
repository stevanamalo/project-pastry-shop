<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htrans extends Model
{
    use HasFactory;
    protected $table = 'htrans';
    public $timestamps = false;
    protected $fillable = ['user_id', 'tanggal', 'membership_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function dtrans()
    {
        return $this->hasMany(Dtrans::class, 'id_htrans');
    }
}
