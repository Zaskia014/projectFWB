<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'price',
        'status',
        'transaction_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->transaction_date)->translatedFormat('d F Y, H:i');
    }

    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }
}
