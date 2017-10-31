<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for storing roles
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->integer('admin_id')->unsigned();
            $table->integer('admin_roles_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('admins')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_roles_id')->references('id')->on('admin_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_id', 'admin_roles_id']);
        });

        // Create table for storing permissions
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('admin_permission_role', function (Blueprint $table) {
            $table->integer('admin_permissions_id')->unsigned();
            $table->integer('admin_roles_id')->unsigned();

            $table->foreign('admin_permissions_id')->references('id')->on('admin_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('admin_roles_id')->references('id')->on('admin_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_permissions_id', 'admin_roles_id'],'admin_permission_role_role_id_foreign');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('admin_permission_role');
        Schema::drop('admin_permissions');
        Schema::drop('admin_role_user');
        Schema::drop('admin_roles');
    }
}
