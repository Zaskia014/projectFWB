<h4 class="mt-5 mb-4">💬 Ulasan Pengguna</h4>

@forelse ($book->reviews as $review)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0">
                        <strong>{{ $review->user->name }}</strong>
                        <span class="badge bg-warning text-dark ms-2">⭐ {{ $review->rating }}/5</span>
                    </h6>
                    <p class="mb-1">{{ $review->review }}</p>
                </div>

                @if (auth()->id() === $review->user_id)
                    <div class="text-end">
                        <a href="{{ route('user.reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                        <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus ulasan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        Belum ada ulasan untuk buku ini.
    </div>
@endforelse
