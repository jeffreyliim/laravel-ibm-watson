<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Video
 *
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property string $name
 * @property string $path
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Video whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Video extends Model
{
    protected $fillable = [
        'path', 'name'
    ];


    public static function storeMp3($request)
    {
        return static::create([
            'path' => '/mp3/',
            'name' => $request->getClientOriginalName() . '.mp3'
        ]);
    }
}
