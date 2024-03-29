@extends('layouts.app')

@section('content')
    <div class="conatiner">
        <div class="row bg-text pt-4 mb-3">
            <form method="POST" href="/bugreport">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="mb-3">
                    <label for="text" class="form-label">Írja le az észlelt hibát:</label></label>
                    <textarea id="text" name="Text" class="form-control" aria-label="With textarea" aria-describedby="messageHelp"
                        rows="6"></textarea>
                </div>

                <button type="submit" class="btn btn-info">Jelentés küldése</button>
            </form>
        </div>
        <div class="row bg-text pt-4">
            <label><b>FIGYELEM:</b> Amennyiben be van jelentkezve, az email címe mentésre kerül a jelentésével, és a hiba állapotáról további üzeneteket kaphat.</label>
        </div>
    </div>
@endsection
