<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'doc',
        'type',
        'active',
        'category_id', 'size'

    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
