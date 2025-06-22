<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi massal
     */
    protected $fillable = [
        'user_id',
        'status',           // contoh: pending, success, canceled
        'total_price',
        'transaction_date',
    ];

    /**
     * Relasi ke user yang melakukan transaksi
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke buku yang dibeli dalam transaksi ini (pivot: book_transaction)
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_transaction')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    /**
     * Format tanggal transaksi (opsional)
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->transaction_date)->translatedFormat('d F Y, H:i');
    }

    /**
     * Apakah transaksi sukses?
     */
    public function isSuccessful()
    {
        return $this->status === 'success';
    }
}
