<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoreds', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('document', 14);
            $table->string('email');
            $table->string('bank', 3);
            $table->string('agency')->nullable();
            $table->string('agencyDigit')->nullable()->default('0');
            $table->string('account');
            $table->string('accountDigit')->default('0');
            $table->enum('accountType', ['CONTA_CORRENTE', 'CONTA_POUPANCA', 'CONTA_FACIL']);
            $table->boolean('valid')->default(false);
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
        Schema::dropIfExists('favoreds');
    }
}
