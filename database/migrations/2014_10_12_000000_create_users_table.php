<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('branch_id');
            $table->uuid('country_id');
            $table->uuid('role_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->nullable();
            $table->string('employee_number')->nullable()->unique();
            $table->string('employee_designation')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_self_evaluated')->default(false);
            $table->boolean('is_evaluated')->default(false);
            $table->rememberToken();
            $table->dateTime('joining_date')->nullable();
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
        Schema::dropIfExists('users');
    }
}
