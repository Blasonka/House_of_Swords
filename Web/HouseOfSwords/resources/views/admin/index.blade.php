@extends('layouts.app')
<link rel="stylesheet" href="/css/table.css">
@section('content')
    {{-- <div class="row bg-text mt-3">
        <div class="col-12">
            <h1 class="text-center display-3">Egy admin oldal...</h1>
        </div>
    </div> --}}

    <div class="container py-5">
        <h2 class="mb-3 text-center">Hibák</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Occupation</th>
                        <th scope="col">Hiba jelenlegi státusza</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr scope="row">
                        <td>00</td>
                        <td><a href="#">user@email.com</a></td>
                        <td><small class="d-block">Valami</small></td>
                        <td class="status"><span class="bug">Bug</span></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            </div>
                        </td>
                    </tr>

                    @foreach ($bugs as $bug)
                        <tr scope="row">
                            <td>
                                {{ $bug->Id }}
                            </td>
                            <td><a href="#">user@email.com</a></td>
                            <td><small class="d-block">{{ $bug->Text }}</small></td>
                            <td class="status"><span class="fixed">Feature</span></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
