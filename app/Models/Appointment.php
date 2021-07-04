<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Appointment extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    public $fillable = ['name'];

}
