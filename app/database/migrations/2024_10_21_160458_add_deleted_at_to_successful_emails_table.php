<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToSuccessfulEmailsTable extends Migration
{
    public function up()
    {
        Schema::table('successful_emails', function (Blueprint $table) {
            $table->softDeletes(); // Adiciona a coluna deleted_at
        });
    }

    public function down()
    {
        Schema::table('successful_emails', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Remove a coluna deleted_at
        });
    }
}
