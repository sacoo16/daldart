<?php

namespace App\Models;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    public $table = 'albums';

    protected $fillable = [
        'name'
    ];

    // relation with pictures table .. related has many.
    public function pictures() : HasMany
    {
        return $this->hasMany(Picture::class,'album_id');
    }
}
