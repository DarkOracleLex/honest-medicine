<?php

use App\Models\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->string('model');
            $table->foreignIdFor(Item::class, 'model_id');
            $table->json('changes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('changes');
    }
};
