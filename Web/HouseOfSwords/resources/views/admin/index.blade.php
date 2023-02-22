@extends('layouts.app')
<link rel="stylesheet" href="/css/table.css">
@section('content')
    <div class="container py-5">
        <h2 class="mb-3 text-center">Hibák</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th scope="col" width="5%">Id</th>
                        <th scope="col" width="20%">Email</th>
                        <th scope="col" width="40%">Occupation</th>
                        <th scope="col" width="15%">Hiba státusza</th>
                        <th scope="col" width="10%">Státusz változtatása</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bugs as $bug)
                        <tr scope="row">
                            <td>
                                {{ $bug->Id }}
                            </td>
                            <td><a href="#">user@email.com</a></td>
                            <td><small class="d-block">{{ $bug->Text }}</small></td>
                            @if ($bug->IsSolved == 0)
                                <td class="status"><span class="bug bug-bg">Megoldatlan</span></td>
                            @elseif ($bug->IsSolved == 1)
                                <td class="status"><span class="inprogress inprogress-bg">Folyamatban</span></td>
                            @else
                                <td class="status"><span class="fixed fixed-bg">Megoldva</span></td>
                            @endif
                            {{-- gombok, a státusz állításához --}}
                            <td class="status">
                                <div class="row mx-auto">
                                    <div class="col-1">
                                        <form action="/api/bugreports" method="POST">
                                            @method('PATCH')
                                            <input name="IsSolved" value="2" type="text" hidden>
                                            <input name="Id" value="{{$bug->Id}}" type="text" hidden>
                                            <button type="submit" class="btn btn-sm btn-success btn-fixed"></button>
                                        </form>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" class="btn btn-sm btn-warning btn-inprogress"></button>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" class="btn btn-sm btn-danger btn-bug"></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
