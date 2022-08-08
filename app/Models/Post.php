<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    use HasFactory;
    public static function allPost()
    {
    $files = File::files(resource_path('posts/'));
       return array_map(function($file){
            return $file->getContents();
        },$files);
    }
    public static function find($slug){

        if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }
        return cache()->remember("posts/{post}", 1, fn () => file_get_contents($path));

    }

}
