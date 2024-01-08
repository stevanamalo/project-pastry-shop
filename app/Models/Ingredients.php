<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredients extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ingredients';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', // Add 'id' to the fillables array
        'nama',
        'supplier_id',
    ];

    // Define the relationship with the Supplier model
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected $dates = ['deleted_at'];
}
