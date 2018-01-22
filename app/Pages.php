<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = ['title', 'slug', 'content', 'public'];

    protected $dates = ['deleted_at'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($page) {
            $page->update(['slug' => $page->title]);
        });
    }

    /**
     * Render the page using the default view.
     *
     * @param bool $viewFile
     * @return \Illuminate\View\View
     */
    public function path()
    {
      return "/blog/{$this->slug}";
    }

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function setSlugAttribute($value)
    {
      if(static::whereSlug($slug = str_slug($value))->exists()) {
        $slug = "{$slug}-{$this->id}";
      }

      $this->attributes['slug'] = $slug;
    }

}
