<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alternatif')->constrained('alternatifs')->onDelete('cascade');
            $table->foreignId('id_kriteria')->constrained('criterias')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
}
