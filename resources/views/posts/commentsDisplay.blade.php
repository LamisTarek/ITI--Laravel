@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
    </div>
@endforeach
