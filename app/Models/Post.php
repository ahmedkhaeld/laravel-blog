<?php

namespace App\Models; 

use Illuminate\Support\Facades\File;

class Post 
{

    public static function all()
    {
        $files=File::files(resource_path("posts/"));

        return array_map( fn($file)=> $file->getcontents(), $files);
    }


    public static function find($slug)
    {
            //  fetch post path from resources folder, path not exists throw model not found exception
        if(! file_exists($path=resource_path("posts/{$slug}.html"))){
            return redirect('/');
        }

        //caching allowing avoid expensive access file_get_contents every time user clicks on a posts instead save it in memory
        return cache()->remember("post.{$slug}", 1200 ,fn()=> file_get_contents($path));
    }

}
