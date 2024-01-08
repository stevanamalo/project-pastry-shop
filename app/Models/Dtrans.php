<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtrans extends Model
{
    use HasFactory;
    protected $table = 'dtrans';
    public $timestamps = false;
    protected $fillable = ['id_htrans', 'item', 'harga'];

    public function htrans()
    {
        return $this->belongsTo(Htrans::class, 'id_htrans');
    }
}
