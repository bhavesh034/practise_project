<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Slider extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'slider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'content',
        'button1_text',
        'button1_url',
        'button2_text',
        'button2_url',
        'position',
        'img',
    ];
}
