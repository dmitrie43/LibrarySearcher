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
            $table->string('cover_img')->nullable();
            $table->integer('pages_quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('age_rating')->nullable();
            $table->set('novelty', [0, 1])->default(0);
            $table->set('popular', [0, 1])->default(0);
            $table->set('recommended', [0, 1])->default(0);

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
