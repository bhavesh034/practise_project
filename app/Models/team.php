<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class team extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'designation',
        'detail',
        'facebook',
        'twitter',
        'linkedin',
        'googlsplus',
        'flickr',
        'instagram',
        'email',
        'phone',
        'website',
        'img',
    ];
}
