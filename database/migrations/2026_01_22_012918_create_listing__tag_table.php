<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            
            $table->primary(['listing_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_tag');
    }
};
