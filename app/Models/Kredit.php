<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Kredit extends Model
{
    use Notifiable, HasFactory,HasApiTokens;

    protected $table = 'kredit';

    protected $fillable = [
        'idpegawai',
        'total',
        'date',
    ];
}
