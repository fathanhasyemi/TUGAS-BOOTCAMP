<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan kolom slug setelah kolom name, bersifat nullable dulu agar produk lama tidak error
            $table->string('slug')->nullable()->after('name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus kolom slug jika migration di-rollback
            $table->dropColumn('slug');
        });
    }
}