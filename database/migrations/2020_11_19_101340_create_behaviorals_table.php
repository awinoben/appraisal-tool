<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehavioralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behaviorals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('project_id');
            $table->uuid('user_id');
            $table->string('type');
            $table->double('employee_ratings')->default(0.0);
            $table->longText('employee_comments')->nullable();
            $table->double('supervisor_ratings')->default(0.0);
            $table->longText('supervisor_comments')->nullable();
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
        Schema::dropIfExists('behaviorals');
    }
}
