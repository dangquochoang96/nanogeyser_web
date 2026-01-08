<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToCertificationsTable extends Migration
{
    public function up()
    {
        Schema::table('nk_certifications', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('status');
        });
    }

    public function down()
    {
        Schema::table('nk_certifications', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
