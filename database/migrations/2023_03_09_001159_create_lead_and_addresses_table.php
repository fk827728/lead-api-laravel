<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const MAX_STRING_LENGTH = 255;
    const PHONE_LENGTH = 10;
    const STATE_ABBREVIATION_LENGTH = 2;
    const ZIP_CODE_LENGTH = 5;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', self::MAX_STRING_LENGTH)->nullable();
            $table->string('last_name', self::MAX_STRING_LENGTH)->nullable();
            $table->string('email', self::MAX_STRING_LENGTH)->nullable();
            $table->char('phone', self::PHONE_LENGTH)->nullable();
            $table->integer('electric_bill')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', self::MAX_STRING_LENGTH)->nullable();
            $table->string('city', self::MAX_STRING_LENGTH)->nullable();
            $table->char('state_abbreviation', self::STATE_ABBREVIATION_LENGTH)->nullable();
            $table->char('zip_code', self::ZIP_CODE_LENGTH)->nullable();
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_lead_id_foreign');
        });
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('leads');
    }
};
