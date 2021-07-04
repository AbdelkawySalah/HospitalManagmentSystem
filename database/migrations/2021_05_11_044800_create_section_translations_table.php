<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
          $table->id(); // Laravel 5.8+ use bigIncrements() instead of increments()
          //بيتسجل فيه اللغة اللي انا واقف عليها 			
          $table->string('locale')->index();
          $table->LongText('description');
            // Foreign key to the main model
            $table->unsignedBigInteger('section_id');
            //هنا بيقول ان الحقل مينفعش يكرر بنفس اللغة مرتين 
            $table->unique(['section_id', 'locale']);
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
             // هنا بذكر الحقول اللي هيتعملها ترجمة
           $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_translations');
    }
}
