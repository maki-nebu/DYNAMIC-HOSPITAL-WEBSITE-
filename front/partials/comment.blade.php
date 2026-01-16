<div class="comment {{ $comment->parent_id ? 'reply ms-4 mt-2' : '' }}" data-id="{{ $comment->id }}">
    <strong>{{ $comment->name }}</strong>
    <small>• {{ $comment->created_at->diffForHumans() }}</small>
    <p>{{ $comment->content }}</p>
    <a href="#" class="reply-btn text-primary" data-id="{{ $comment->id }}">Reply</a>

    @if($comment->replies->count() > 0)
        @foreach($comment->replies as $reply)
            @include('front.partials.comment', ['comment' => $reply])
        @endforeach
    @endif
</div>
