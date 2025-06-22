<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    /**
     * Buku yang ditulis oleh user (jika role: author)
     */
    public function authoredBooks()
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    /**
     * Ulasan buku yang ditulis oleh user
     */
    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    /**
     * Relasi favorit melalui pivot (jika ingin $user->favoriteBooks)
     */
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorites');
    }

    /**
     * Relasi ke model Favorite (jika ingin akses id dan data pivot)
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Cek apakah user telah memfavoritkan buku tertentu
     */
    public function hasFavorited(Book $book)
    {
        return $this->favorites()->where('book_id', $book->id)->exists();
    }

    /**
     * Relasi ke transaksi pembelian buku
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Cek apakah user sudah membeli buku tertentu
     */
    public function hasPurchased(Book $book): bool
    {
        return $this->transactions()
            ->whereHas('books', function ($query) use ($book) {
                $query->where('book_id', $book->id);
            })
            ->exists();
    }
}
