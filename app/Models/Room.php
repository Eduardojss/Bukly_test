<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    public $table = 'rooms';

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'hotel_id'
    ];

    public function Hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
