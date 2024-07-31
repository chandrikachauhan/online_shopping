<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
           $table->text('moreInformation')->nullable()->after('campare_price');
           $table->text('spacification')->nullable()->after('moreInformation');
           $table->text('reviews')->nullable()->after('spacification');
           $table->String('related')->nullable()->after('reviews');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('products',function(Blueprint $table){

            $table->dropColumn('moreInformation');
            $table->dropColumn('spacification');
            $table->dropColumn('reviews');
            $table->dropColumn('related');
            
        });
    }
};
