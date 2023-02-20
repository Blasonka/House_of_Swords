@extends('layouts.app')
<link rel="stylesheet" href="/css/table.css">
@section('content')
    <div class="row bg-text mt-3">
        <div class="col-12">
            <h1 class="text-center display-3">Egy admin oldal...</h1>
        </div>
    </div>

    {{-- <div class="container">
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
</div> --}}

<div class="container">

    <h2 class="mb-5">Hibák</h2>


    <div class="table-responsive">

        <table class="table table-striped custom-table">
            <thead>
                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Occupation</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Education</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
        @foreach ($bugs as $bug)

                <tr scope="row">
                    <td>
                        {{$bug->Id}}
                    </td>
                    <td><a href="#">user-email</a></td>
                    <td>
                        Bug text:
                        <small class="d-block">{{$bug->Text}}</small>
                    </td>
                    <td>+63 983 0962 971</td>
                    <td>NY University</td>
                    <td><a href="#" class="more">Details</a></td>

                </tr>
        @endforeach


            </tbody>
        </table>
    </div>
</div>
@endsection
