<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $with=['category', 'author'];

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


    /**
     * @param $query
     * @param array $filters
     *
     * this scope filter will take a list of filter to do on posts table , give back every match up
     * that is like to the filter, here we filter through the title or the body
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false,  fn($query, $search)=>$query
            ->where('title', 'like', '%'. request('search') .'%')
            ->orWhere('body', 'like', '%' . request('search'). '%'));

        // asking posts. posts give me the post that has a slug that is matching what user requested from the dropdown
        $query->when($filters['search'] ?? false,  fn($query, $category)=>
        $query->whereHas('category' ,fn($query)=>
            $query-where('slug', $category))
        );

        // this long query equal to the above two lines
//            ->whereExists(fn($query)=>
//            $query->from('categories')
//            ->whereColumn('categories', 'posts.category_id')
//            ->where('categories.slug', $category))
//            );

    }
}
