<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName',180);
            $table->string('TradingName',180);
            $table->string('ABNNo',15);
            $table->string('BuildingNo',50);
            $table->string('StreetName',200);
            $table->string('City',200);
            $table->integer('CountryCode');
            $table->string('PrimaryContact',20);
            $table->string('SecondryContact',20);
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
        Schema::dropIfExists('companies');
    }
}
