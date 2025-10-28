<?php

namespace Modules\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Course\Database\Factories\ModuleFactory;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'course_id',
        'module_title'
    ];
    protected $primaryKey = 'module_id';

    // protected static function newFactory(): ModuleFactory
    // {
    //     // return ModuleFactory::new();
    // }
    public function contentList()
    {
        return $this->hasMany(Content::class, 'module_id', 'module_id');
    }
}
