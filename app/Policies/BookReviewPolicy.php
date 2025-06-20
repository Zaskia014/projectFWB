<?php

namespace App\Policies;

use App\Models\BookReview;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
{
    // Contoh: admin boleh lihat semua review
    return $user->role === 'admin';
}

public function view(User $user, BookReview $bookReview): bool
{
    // Bisa diatur sesuai kebutuhan, misal pemilik review dan admin boleh lihat
    return $user->id === $bookReview->user_id || $user->role === 'admin';
}

public function create(User $user): bool
{
    // Semua user yang login boleh membuat review
    return in_array($user->role, ['admin', 'author', 'user']);
}

public function update(User $user, BookReview $bookReview): bool
{
    // Hanya pemilik review atau admin yang boleh update
    return $user->id === $bookReview->user_id || $user->role === 'admin';
}

public function delete(User $user, BookReview $bookReview): bool
{
    // Sama seperti update
    return $user->id === $bookReview->user_id || $user->role === 'admin';
}
}