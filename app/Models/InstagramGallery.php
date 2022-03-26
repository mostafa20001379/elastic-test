<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramGallery extends Model
{
    public $fillable = [
        'instagram_id',
        'link',
        'type',

    ];

    public function instagram() {
        return $this->morphMany(\Nahad\Payment\Models\Payment::class, 'payable');
    }

    public const TYPE_IMAGE = 1;
    public const TYPE_VIDEO = 2;

    public const TYPES_TITLES = [
        self::TYPE_IMAGE => 'محتوای عکس',
        self::TYPE_VIDEO => 'محتوای فیلم'
    ];

    public static function getTypesIds() {
        return array_keys(self::TYPES_TITLES);
    }
}
