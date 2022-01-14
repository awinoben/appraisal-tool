<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_developments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_id');
            $table->uuid('user_id');
            $table->string('type')->nullable();
            $table->longText('personal_development')->nullable();
            $table->longText('what_to_do')->nullable();
            $table->longText('achievement')->nullable();
            $table->longText('actions')->nullable();
            $table->longText('manager_comments')->nullable();
            $table->string('on_track')->nullable();
            $table->text('reject_comments')->nullable();
            $table->boolean('is_rated')->default(false);
            $table->boolean('is_accepted')->default(false);
            $table->boolean('is_rejected')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('personal_developments');
    }
}
