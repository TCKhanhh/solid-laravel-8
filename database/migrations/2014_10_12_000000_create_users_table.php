<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id(); // BIGINT primary key

            /* ===== BASIC INFO ===== */
            $table->string('name');
            $table->string('email')->unique();

            /* ===== EMAIL VERIFICATION ===== */
            $table->timestamp('email_verified_at')->nullable();

            /* ===== AUTHENTICATION ===== */
            $table->string('password');

            /* ===== PROFILE ===== */
            $table->string('avatar')->nullable();

            /* ===== ACCOUNT STATUS ===== */
            $table->enum('status', ['active', 'suspended'])->default('active');

            /* ===== SECURITY ===== */
            $table->integer('failed_login_attempts')->default(0);
            $table->timestamp('account_locked_until')->nullable();

            /* ===== LOGIN TRACKING ===== */
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();

            /* ===== REMEMBER TOKEN ===== */
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
