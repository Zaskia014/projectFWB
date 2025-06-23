<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function authoredBooks()
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorites');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function hasFavorited(Book $book)
    {
        return $this->favorites()->where('book_id', $book->id)->exists();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function hasPurchased(Book $book): bool
    {
        return $this->transactions()
            ->where('book_id', $book->id)
            ->exists();
    }
}
