<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Ambulance extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['driver_name','notes'];
    public $fillable= ['car_number','car_model','car_year_made','driver_license_number','driver_phone','is_available','car_type'];

}
