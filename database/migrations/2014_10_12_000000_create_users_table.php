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
            $table->id();
            $table->unsignedBigInteger("client_id")->nullable();
            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->string("email", 150)->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password", 256);
            $table->string("phone", 20);
            $table->string("profile_uri", 255)->nullable();
            $table->timestamp("last_password_reset")->nullable();
            $table->enum("status", ["Active", "Inactive"]);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("client_id")
                ->references("id")
                ->on("clients")
                ->onDelete("cascade");
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
