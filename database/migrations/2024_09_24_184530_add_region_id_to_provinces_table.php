<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionIdToProvincesTable extends Migration
{
    public function up()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->nullable(); // Add region_id column
        });
    }

    public function down()
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('region_id'); // Drop it if needed
        });
    }
}
