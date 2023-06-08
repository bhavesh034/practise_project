<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogsubcategory extends Model
{
    use HasFactory;
    protected $table = 'blog_subcategory';
    protected $fillable = [
        'category_name',
        'subcategory_name',
        'Status',
    ];
}
