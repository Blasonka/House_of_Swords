@extends('layouts.app')

@section('content')
    <form method="POST" href="/send">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="Email" class="form-control" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="Title" class="form-control" id="title" aria-describedby="textHelp">
            <div id="textHelp" class="form-text">Your email title.</div>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Your message</label>
            <textarea id="text" name="Text" class="form-control" aria-label="With textarea" aria-describedby="messageHelp"></textarea>
            <div id="messageHelp" class="form-text">Type your message here</div>
        </div>

        <button type="submit" class="btn btn-primary">Send mail</button>
    </form>
@endsection
