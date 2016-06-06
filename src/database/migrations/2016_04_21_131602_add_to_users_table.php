<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday');
            $table->string('report_subj', 50);
            $table->string('country', 100);
            $table->string('phone', 17);
            $table->string('company', 100)->nullable()->default(null);
            $table->string('position', 50)->nullable()->default(null);
            $table->text('about_me');
            $table->string('photo', 100)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birthday', 'report_subj', 'country', 'phone', 'company', 'position', 'about_me', 'photo']);
        });
    }
}
