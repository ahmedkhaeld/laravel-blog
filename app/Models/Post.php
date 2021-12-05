<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $with=['category', 'author'];

    /**
     * @return BelongsTo category
     */
    public function category(): BelongsTo
    {
        // post belongs to one category
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo  user of a post
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'user_id');
    }


    /**
     * @param $query
     * @param array $filters
     *
     * this scope filter will take a list of filter to do on posts table , give back every match up
     * that is like to the filter, here we filter through the title or the body
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where( fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        // asking posts. posts give me the post that has a slug that is matching what user requested from the dropdown
        $query->when($filters['search'] ?? false,  fn($query, $category)=>
        $query->whereHas('category' ,fn($query)=>
            $query->where('slug', $category))
        );


        $query->when($filters['author'] ?? false,  fn($query, $author)=>
        $query->whereHas('author' ,fn($query)=>
            $query->where('username', $author))
        );



    }
}
