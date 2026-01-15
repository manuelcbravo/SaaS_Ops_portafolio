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
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tenant_id')->index();

            // Polimórfico: Client/Project/Task/etc
            $table->uuidMorphs('owner'); // owner_type, owner_id (UUID)

            $table->uuid('uuid')->unique(); // nombre interno
            $table->string('original_name');
            $table->string('path');
            $table->bigInteger('size_bytes');
            $table->string('mime')->nullable();
            $table->string('visibility')->default('private'); // private|team|public

            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
