<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Portfolio extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'portfolio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_content',
        'content',
        'client_name',
        'client_company',
        'start_date',
        'end_date',
        'web_site',
        'cost',
        'client_content',
        'categories'
    ];
}
