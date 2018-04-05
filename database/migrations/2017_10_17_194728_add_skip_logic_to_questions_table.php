<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSkipLogicToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function($table) {
            $table->dropColumn('survey_id');
            $table->integer('questionable_id');
            $table->string('questionable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function($table) {
            $table->integer('survey_id');
            $table->dropColumn('questionable_id');
            $table->dropColumn('questionable_type');
        });
    }
}
