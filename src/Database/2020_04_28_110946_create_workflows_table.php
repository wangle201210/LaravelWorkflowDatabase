<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->string('supports');
            $table->string('store_type');
            $table->string('store_arguments');
            $table->json('para')->nullable()->comment("其他参数");
            $table->string('remark')->nullable();
            $table->timestamps();
        });
        Schema::create('workflow_places', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('workflow_id');
            $table->string('title');
            $table->timestamps();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onDelete('cascade');
        });
        Schema::create('workflow_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('workflow_id');
            $table->unsignedInteger('from_id');
            $table->unsignedInteger('to_id');
            $table->string('title');
            $table->timestamps();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onDelete('cascade');
            $table->foreign('from_id')
                ->references('id')
                ->on('workflow_places')
                ->onDelete('cascade');
            $table->foreign('to_id')
                ->references('id')
                ->on('workflow_places')
                ->onDelete('cascade');
        });
        Schema::create('action_roles', function (Blueprint $table) {
            $table->unsignedInteger('action_id');
            $table->unsignedInteger('role_id');
            $table->foreign('action_id')
                ->references('id')
                ->on('workflow_actions')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on(config('permission.table_names.roles'))
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
        Schema::dropIfExists('action_roles');
        Schema::dropIfExists('workflow_actions');
        Schema::dropIfExists('workflow_places');
        Schema::dropIfExists('workflows');
    }
}
