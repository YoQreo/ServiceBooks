<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'incomeNumber',
        'volume',
        'availability',
        'acquisitionModality',
        'acquisitionSource',
        'acquisitionPrice',
        'acquisitionDate',
        'publicationLocation',
        'printType',
        'barcode',
        'stand_id',
        'book_id'
    ];

    public function book()
    {
        return $this->belong('App\Models\Book','book_id');
    }
}
