<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_email', function (Blueprint $table) {
            $table->id(); // Colonna ID automatica e autoincrementante
            $table->string('from');
            $table->string('to');
            $table->string('cc')->nullable(); // Campo opzionale
            $table->string('bcc')->nullable(); // Campo opzionale
            $table->string('subject');
            $table->text('body');
            $table->text('attachments')->nullable(); // Campo opzionale
            $table->timestamps(); // Aggiunge le colonne created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_email');
    }
};

