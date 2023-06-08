<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $fillable = [
        'faq_title',
        'content',
        'show_home',
    ];
}
