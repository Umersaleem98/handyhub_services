<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_request_id')->constrained();
            $table->foreignId('provider_id')->constrained('users');
            $table->foreignId('seeker_id')->constrained('users');
            $table->enum('status', [
                'pending', 'confirmed', 'provider_en_route', 'arrived',
                'in_progress', 'completed', 'cancelled_by_provider',
                'cancelled_by_seeker', 'no_show'
            ])->default('pending');
            $table->integer('agreed_price');
            $table->integer('material_cost')->default(0);
            $table->integer('platform_fee')->default(0);
            $table->integer('total_amount');
            $table->json('provider_location_history')->nullable();
            $table->timestamp('provider_en_route_at')->nullable();
            $table->timestamp('provider_arrived_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('seeker_otp')->nullable();
            $table->string('completion_otp')->nullable();
            $table->boolean('otp_verified')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['provider_id', 'status']);
            $table->index(['seeker_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};