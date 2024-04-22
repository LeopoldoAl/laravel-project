<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // We add the field photo
            $table->string('photo', 255)->nullable();
            /*
                Now we should the relationship with the table for that
                exists two ways.
                First:
                we will use in this course
            */
            $table->string('profession', 60)->nullable();
            $table->string('about', 255)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('linkedin', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            // Now we stablish the relationship
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                // If it is deleted a user as well deletes the profile
                ->onDelete('cascade')
                // If it is updated a user as well updates the profile
                ->onUpdate('cascade');
            
            // Second way is using the conventions and it's shorter 
            // $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
