<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', [
                'income',
                'expense'
            ]);

            $table->string('name');
            $table->bigInteger('amount');
            $table->unsignedInteger('company_id');
            $table->boolean('received');

            $table->text('notes');

            $table->timestamps();

            $table->index('type');
            $table->index('company_id');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
