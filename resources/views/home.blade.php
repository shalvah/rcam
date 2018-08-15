<!doctype html>
<html>
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
        <button id="addCommentBtn">Comment</button>
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


<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script>
    function displayComment(data) {
        let $comment = $('<div>').text(data['text']).prepend($('<small>').html(data['username'] + "<br>"));
        $('#comments').prepend($comment);
    }

    function addComment (event) {

        function showAlert(message) {
            let $alert = $('#alert');
            $alert.text(message).show();
            setTimeout(() => $alert.hide(), 4000);
        }

        event.preventDefault();
        $('#addCommentBtn').attr('disabled', 'disabled');
        let data = {
            text: $('#text').val(),
            username: $('#username').val(),
        };
        fetch('/comments', {
            body: JSON.stringify(data),
            credentials: 'same-origin',
            headers: {
                'content-type': 'application/json',
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                'x-socket-id': window.socketId
            },
            method: 'POST',
            mode: 'cors',
        }).then(response => {
            $('#addCommentBtn').removeAttr('disabled');
            if (response.ok) {
                displayComment(data);
            } else {
                showAlert('Your comment was not approved for posting. Please be nicer :)');
            }
        })
    }
</script>

<script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<script>
    var socket = new Pusher("your-app-key", {
        cluster: 'your-app-cluster',
    });
    socket.connection.bind('connected', function() {
        window.socketId = socket.connection.socket_id;
    });
    socket.subscribe('comments')
        .bind('new-comment',displayComment);
</script>

</body>
</html>
