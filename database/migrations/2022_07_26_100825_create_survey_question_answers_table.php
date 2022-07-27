<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\surveyQuestion;
use App\Models\surveyAnswer;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(surveyQuestion::class,"surveyQuestion_id");
            $table->foreignIdFor(surveyAnswer::class,"surveyAnswer_id");
            $table->text("answer");
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
        Schema::dropIfExists('survey_question_answers');
    }
};
