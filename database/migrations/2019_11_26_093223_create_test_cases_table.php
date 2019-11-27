<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jira_id');
            $table->string('release_version');
            $table->unsignedInteger('module_id');
            $table->text('objective');
            $table->text('steps');
            $table->text('data');
            $table->text('expected_result');
            $table->text('actual_result')->nullable();
            $table->tinyInteger('status');
            $table->boolean('is_regression');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('test_cases');
    }
}
