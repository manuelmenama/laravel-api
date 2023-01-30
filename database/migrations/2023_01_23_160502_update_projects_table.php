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
        Schema::table('projects', function (Blueprint $table) {
            //per la foreign key degli user
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('type_id')->nullable()->after('user_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //va prima detto che sto eliminando una FK
            $table->dropForeign(['user_id']);
            //successivamente posso eliminare tutta la colonna
            $table->dropColumn('user_id');

            //va prima detto che sto eliminando una FK
            $table->dropForeign(['type_id']);
            //successivamente posso eliminare tutta la colonna
            $table->dropColumn('type_id');

        });
    }
};
