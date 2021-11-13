<?php

namespace App\Models; 

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post 
{
    public $body;

    public function __construct(
        public $title, 
        public $excerpt,
        public $date ,
        $body,
        public $slug  
    )
    {
        $this->body=$body;
    }


   

    public static function all()
    {
        return cache()->rememberForever('posts.all', function(){
            return collect(File::files(resource_path("posts")))

            ->map(fn($file)=>YamlFrontMatter::parseFile($file)) 
    
            ->map(fn($document)=>new Post(
    
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            ))->sortByDesc('date');
        
        });
       
    }


    public static function find($slug)
    {
        // of all the blog posts, find the one with a slug that mathches the one that was requested
        return static::all()->firstwhere('slug', $slug);
    }

}
