@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-text pt-4">
            <div class="card text-bg-dark border-info mb-3 mx-auto" style="max-width: 18rem;">
                <img src="img/windows.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center">Windows 10</h5>
                    <p class="card-text text-center">Játék letöltése számítógépre<br><i>(Windows 10)</i></p>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <form method="get" action="/downloadWindows">
                            <button type="submit" class="btn btn-primary">LETÖLTÉS</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card text-bg-dark border-success mb-3 mx-auto" style="max-width: 18rem;">
                <img src="img/android.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title card-title-green text-center">Andoid</h5>
                    <p class="card-text card-text-green text-center">Játék letöltése telefonra<br><i>(Android)</i></p>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <form method="get" action="/downloadAndroid">
                            <button type="submit" class="btn btn-success">LETÖLTÉS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
