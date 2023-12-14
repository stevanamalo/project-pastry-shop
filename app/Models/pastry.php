<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pastry extends Model
{
    use HasFactory;

    protected $table = 'pastry';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'nama', 'harga','picturepastry', 'ingredients_id',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class, 'ingredients_id');
    }
}
