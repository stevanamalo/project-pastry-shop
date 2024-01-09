<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    
    protected $table = 'cart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'nama',
    ];
    
    public function ingredient()
    {
        return $this->belongsTo(pastry::class, 'pastry_id');     
    }
    
}
