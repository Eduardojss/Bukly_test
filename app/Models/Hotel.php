<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    public $table = 'hotels';

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'website',
        'user_id'
    ];

    public function Room()
    {
        return $this->hasMany(Room::class, 'hotel_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
