<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Patient extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name','Address'];
    public $fillable=['email','Password','Date_Birth','Phone','Gender','Blood_Group'];
}
