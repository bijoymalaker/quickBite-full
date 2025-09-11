<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE TABLE `orders` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
          `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
          `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
          `amount` double DEFAULT NULL,
          `address` text COLLATE utf8_unicode_ci,
          `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
          `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
          `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS `orders`;");
    }
};
