@extends('admin.backend.layouts.app')

@section('Content')
    <div class="container">
        <h1>Send Email to {{ $order->email }}</h1>

        <!-- Product creation form -->
        <form action="{{ route('admin.send_user_email', $order->user_id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstline">firstline</label>
                <input type="text" name="firstline" id="firstline" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="body">body</label>
                <input type="text" name="body" id="body" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="button">button</label>
                <input type="text" name="button" id="button" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="url">url</label>
                <input type="text" name="url" id="url" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="lastline">lastline</label>
                <input type="text" name="lastline" id="lastline" class="form-control" required>
            </div>

            
            <button type="submit" class="btn btn-primary">Send</button>
            <br>
        </form>

    </div>
@endsection
