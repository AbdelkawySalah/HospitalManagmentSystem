<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
           //رقم الفاتورة في حالة انها نقدي
           //nullable  يعني ممكن لو فاتورة نقدي فهيبقي فيه رقم فاتورة او لو كان سند قبض مش هيبقي فيه رقم فاتورة بس هيبقي فيه سند قبض
            $table->foreignId('single_invoice_id')->nullable()->references('id')->on('single_invoices')->onDelete('cascade');
          // سند القبض في حالة انه الفاتورة اجل
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->onDelete('cascade');
            //Debit مدين يعني فلوس دخلت 
           //Credit دائن يعني فلوس خرجت من صندوق
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
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
        Schema::dropIfExists('fund_accounts');
    }
}
