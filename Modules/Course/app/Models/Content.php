<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Course\Database\Factories\ContentFactory;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'content_title',
        'video_source',
        'video_url',
        'video_length',
    ];

    protected $primaryKey = 'content_id';

    // protected static function newFactory(): ContentFactory
    // {
    //     // return ContentFactory::new();
    // }
}
