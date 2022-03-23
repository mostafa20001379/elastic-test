<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InstagramGallery;

class CreateInstagramGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instagram_id');
            $table->string('link');
            $table->enum('type', InstagramGallery::getTypesIds());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_galleries');
    }
}
