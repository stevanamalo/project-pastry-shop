<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pastry extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pastry';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nama', 'harga', 'picturepastry', 'ingredients_id', 'Stok'];
    
    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class, 'ingredients_id');
    }

    protected $dates = ['deleted_at'];
}
