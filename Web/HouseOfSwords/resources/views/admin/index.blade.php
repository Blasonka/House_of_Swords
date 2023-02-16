@extends('layouts.app')

@section('content')

<div class="row bg-text mt-3">
    <div class="col-12">
        <h1 class="text-center display-3">Egy admin oldal...</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach ($bugs as $bug)
        <div class="card my-3 mx-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Bug:{{$bug->Id}}</h5>
              <p class="card-text">{{$bug->Text}}</p>
              <a href="" class="btn btn-primary disabled">Probléma megoldva</a>
            </div>
          </div>
        @endforeach
    </div>
</div>

@endsection
