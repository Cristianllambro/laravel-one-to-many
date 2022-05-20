<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';        
    }

    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    static public function genSlug($data) {
        $elementSlug = Str::of($data)->slug('-')->__toString();
        $slug = $elementSlug;
        $i = 1;
        while(self::where('slug', $slug)->first()) {
            $slug = "$elementSlug-$i";
            $i++;
        }
        return $slug;
    }
}
