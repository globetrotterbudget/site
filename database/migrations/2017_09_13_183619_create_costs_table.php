<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function(Blueprint $table){
            $table->increments('id');
            
            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips');

            //average_accommodation_cost_per_day
            $table->float('accom_day_cost');

            //average_accommodation_cost
            $table->float('accom_cost');

            //average_food_cost_per_day
            $table->float('avg_food_day_cost');

            //average_food_cost
            $table->float('avg_food_cost');

            //average_transportation_cost_per_day
            $table->float('avg_trans_day_cost');

            //average_transportation_cost
            $table->float('avg_trans_cost');

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
        Schema::drop('sessions');
    }
}
            




        
        
