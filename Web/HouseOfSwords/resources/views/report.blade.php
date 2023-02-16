@extends('layouts.app')

@section('content')
    <div class="conatiner">
        <div class="row bg-text pt-4">
            <form method="POST" href="/bugreport">
                @csrf

                <div class="mb-3">
                    <label for="text" class="form-label">Írja le az észlelt hibát:</label></label>
                    <textarea id="text" name="Text" class="form-control" aria-label="With textarea" aria-describedby="messageHelp" style="height: 200px"></textarea>
                </div>

                <button type="submit" class="btn btn-info">Jelentés küldése</button>
            </form>
        </div>
    </div>
@endsection
