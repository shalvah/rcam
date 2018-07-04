<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rcam</title>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            padding: 20px;
        }

        input {
            border: 2px solid blue;
            font-size: 16px;
            padding: 5px;
        }

        button {
            font-size: 16px;
            padding: 5px;
        }
    </style>
</head>
<body>
<h2>Post title</h2>
This is a dummy post. There isn't really much to it, but it could be really fun if you're bored. Speaking of bored, did
you hear the joke about the blackboard that had...oh, never mind. I'm not allowed to say that. Just drop a comment and
be on your merry way. Wait, did I tell you this is a dummy post?

<br><br>
<div>
    <h3>Comments</h3>
    <form onsubmit="addComment(event);">
        <input type="text" placeholder="Add a comment" name="text" id="text" required>
        <input type="text" placeholder="Your name" name="username" id="username" required>
        <button>Comment</button>
    </form>
    <div class="alert" id="alert" style="display: none;"></div>
    <br>

    <div id="comments">
        @foreach($comments as $comment)
            <div>
                <small>{{ $comment->username }}</small>
                <br>
                {{ $comment->text }}
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
