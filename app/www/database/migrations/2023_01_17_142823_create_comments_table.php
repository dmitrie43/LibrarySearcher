<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->text('text');
            $table->set('recommended', [0, 1])->default(0);
            $table->boolean('is_approved')->default(0);

            $table->foreignId('section')->nullable()->constrained('sections_comments');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('item_id')->nullable();

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
        Schema::dropIfExists('comments');
    }
}
