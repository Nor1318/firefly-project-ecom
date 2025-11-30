<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->after('address_id');
            $table->decimal('subtotal', 8, 2)->default(0)->after('coupon_id');
            $table->decimal('shipping', 8, 2)->default(0)->after('subtotal');
            $table->decimal('discount', 8, 2)->default(0)->after('shipping');
            $table->decimal('total', 8, 2)->default(0)->after('discount');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['coupon_id', 'subtotal', 'shipping', 'discount', 'total']);
        });
    }
};