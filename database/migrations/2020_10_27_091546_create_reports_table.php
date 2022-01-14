<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('result_id');
            $table->uuid('project_id');
            $table->uuid('key_result_area_id');
            $table->double('self_rating')->default(0.0);
            $table->longText('self_remarks')->nullable();
            $table->double('appraiser_rating')->default(0.0);
            $table->longText('appraiser_remarks')->nullable();
            $table->double('overall_rating')->default(0.0);
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
        Schema::dropIfExists('reports');
    }
}
