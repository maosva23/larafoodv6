<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('plan_id'); //chave estrangeira
            $table->uuid('uuid');

            $table->string('nif')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

//          Status Tenant (Se inativa 'N' ele perde o acesso ao sistema)
            $table->enum('active', ['Y','N'])->default('Y');

//          Subscriptions
            $table->date('subscription')->nullable(); //Data que se inscreveu
            $table->date('expires_at')->nullable(); //Data que expira o acesso
            $table->string('subscription_id', 255)->nullable(); //Identificação do Gateway de acesso
            $table->string('subscription_active')->default(false); //Assinatura activa
            $table->string('subscription_suspended')->default(false); //Assinatura cancelada

            $table->foreign('plan_id')->references('id')->on('plans');


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
        Schema::dropIfExists('tenants');
    }
}
