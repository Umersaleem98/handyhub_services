<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seeker_id')->constrained('users');
            $table->foreignId('category_id')->constrained('service_categories');
            $table->text('description');
            $table->json('images')->nullable();
            $table->enum('urgency', ['low', 'medium', 'high', 'emergency'])->default('medium');
            $table->enum('status', [
                'draft', 'published', 'quoted', 'accepted', 
                'in_progress', 'completed', 'cancelled', 'disputed'
            ])->default('draft');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('address');
            $table->string('address_details')->nullable();
            $table->integer('budget_min')->nullable();
            $table->integer('budget_max')->nullable();
            $table->integer('final_price')->nullable();
            $table->timestamp('preferred_date')->nullable();
            $table->enum('preferred_time', ['morning', 'afternoon', 'evening', 'anytime'])->default('anytime');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'created_at']);
            $table->index(['seeker_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};