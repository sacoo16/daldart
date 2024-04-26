<?php

namespace App\Models;

use App\Models\Album;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Picture extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $table = 'pictures';

    protected $appends = [
        'picture',
    ];

    protected $fillable = [
        'name',
        'album_id',
    ];

    public function album() : BelongsTo
    {
        return $this->belongsTo(Album::class,'album_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPictureAttribute()
    {
        $file = $this->getMedia('pictures')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
