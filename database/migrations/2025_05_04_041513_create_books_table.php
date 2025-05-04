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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_image')->nullable(); // nama file atau path cover
            $table->string('file_url'); // nama file atau path buku digital
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // penulis
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
                                                                                
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
