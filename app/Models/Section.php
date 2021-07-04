<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Section extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['name','description'];
    public $translatedAttributes = ['name','description'];

    //عشان اجيب الدكاترة الخاصين بكل قسم
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }


}
