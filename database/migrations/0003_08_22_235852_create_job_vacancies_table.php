<?php

use App\Models\JobVacancy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description');
            $table->unsignedInteger('salary');
            $table->string('location')->index();
            $table->string('category')->index();
            $table->enum('level', JobVacancy::$levels);
            $table->enum('status', JobVacancy::$statuses)->index();
            $table->timestamps();

            $table->foreignIdFor(Employer::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
