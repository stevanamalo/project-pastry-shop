<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'id';
    public $timestamps = false; // Sesuaikan dengan kebutuhan Anda
    public $incrementing = true; // Sesuaikan dengan kebutuhan Anda

    protected $fillable = [
        'user_id', // Sesuaikan dengan nama kolom yang sesuai
        'pastry_id',
        'quantity',
    ];

    public function pastry()
    {
        return $this->belongsTo(Pastry::class, 'pastry_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
