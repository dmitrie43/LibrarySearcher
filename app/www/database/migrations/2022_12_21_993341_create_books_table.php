<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_publish');
            $table->string('file')->nullable();
            $table->string('cover_img')->nullable();
            $table->integer('pages_quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('age_rating')->nullable();
            $table->boolean('is_novelty')->default(0);
            $table->boolean('is_popular')->default(0);
            $table->boolean('is_recommended')->default(0);

            $table->foreignId('author_id')->nullable()->constrained('authors');
            $table->foreignId('publisher_id')->nullable()->constrained('publishers');

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
        Schema::dropIfExists('books');
    }
}
