<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'description',
        'cover_image',
        'price',
        'published_date',
    ];

    /**
     * Relasi ke penulis (User dengan role 'author')
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relasi ke kategori buku
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke ulasan buku
     */
    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    /**
     * Relasi ke user yang memfavoritkan buku ini (melalui pivot favorites)
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Hitung rata-rata rating dari semua review
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    /**
     * Relasi ke transaksi melalui tabel pivot book_transaction
     */
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'book_transaction')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    /**
     * Hitung jumlah total review
     */
    public function totalReviews()
    {
        return $this->reviews()->count();
    }

    /**
     * Cek apakah buku ini telah difavoritkan oleh user tertentu
     */
    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }
}
