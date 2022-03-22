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
            $table->increments('id');
            $table->string('user_id');
            $table->string('title');
            $table->string('qty');
            $table->string('image');
            $table->string('book_lang');
            $table->string('price')->nullable();
            $table->string('description')->nullable();
            $table->string('author_name');
            $table->integer('type_book'); //new or using;
            $table->string('annulment_no')->nullable();
            $table->string('years_publish')->nullable();
            $table->integer('size_paper_cd')->nullable();
            $table->integer('color_paper_cd')->nullable();
            $table->integer('color_print_cd')->nullable();
            $table->integer('side_print_cd')->nullable();
            $table->integer('cover_cd')->nullable();
            $table->integer('side_cover_cd')->nullable();
            $table->integer('status_using_book_cd')->nullable();
            $table->integer('status_publish_cd')->nullable();
            $table->integer('version_type_book_cd')->nullable();
            $table->integer('status_cd')->default(2);
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
