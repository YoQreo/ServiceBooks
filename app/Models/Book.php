<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'secondaryTitle',
        'isbn',
        'clasification',
        'year',
        'tome',
        'edition',
        'extension',
        'dimensions',
        'accompaniment',
        'observations',
        'chapters',
        'summary',
        'keywords'
    ];

    public function copies()
    {
        return $this->hasMany('App\Models\BookCopy','book_id');
    }
}
