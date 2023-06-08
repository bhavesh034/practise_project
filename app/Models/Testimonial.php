<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Testimonial extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'testimonial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_name',
        'company_name',
        'description',
        'Status',
        'img',
    ];
}
