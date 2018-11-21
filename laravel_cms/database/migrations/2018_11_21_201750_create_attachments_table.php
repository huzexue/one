<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->default('')->comment('图片原始名称');
            $table->string('path')->default('')->comment('文件路径');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('用户ID');
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
        Schema::dropIfExists('attachments');
    }
}
