<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>Create a new Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="body">Body:</label>
        <textarea name="body" id="body" required></textarea>
        <br><br>
        <label for="comment">Initial Comment (optional):</label>
        <textarea name="comment" id="comment"></textarea>
        <br><br>
        <button type="submit">Create Post</button>
    </form>

    <h2>Posts List</h2>
    @foreach($posts as $post)
        <div>
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>

            <h4>Comments</h4>
            @foreach($post->comments as $comment)
                <p>{{ $comment->comment }}</p>
            @endforeach

            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <label for="comment">Add Comment:</label>
                <input type="text" name="comment" id="comment" required>
                <button type="submit">Submit</button>
            </form>
        </div>
        <hr>
    @endforeach
</body>
</html>
