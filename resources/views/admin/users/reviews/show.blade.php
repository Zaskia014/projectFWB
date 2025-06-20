<h4>Ulasan Pengguna:</h4>
@foreach($book->reviews as $review)
    <div class="border p-2 mb-2">
        <strong>Rating: {{ $review->rating }}</strong><br>
        <p>{{ $review->review }}</p>

        @if(auth()->id() == $review->user_id)
            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        @endif
    </div>
@endforeach
