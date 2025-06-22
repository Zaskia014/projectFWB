<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    // Relasi ke buku yang ditulis
    public function authoredBooks()
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    // Relasi ke ulasan
    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    // Relasi ke tabel pivot favorit
    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorites');
    }

    // Relasi ke model Favorite
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // ✅ Tambahkan fungsi ini untuk cek apakah user sudah memfavoritkan buku
    public function hasFavorited(Book $book)
    {
        return $this->favorites()->where('book_id', $book->id)->exists();
    }
    public function transactions()
{
    return $this->hasMany(Transaction::class);
}

}
