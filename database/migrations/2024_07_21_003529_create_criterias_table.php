<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriasTable extends Migration
{
    public function up(): void
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->string('nama_kriteria')->nullable();
            $table->string('criteria_type');
            $table->decimal('weight', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
}
