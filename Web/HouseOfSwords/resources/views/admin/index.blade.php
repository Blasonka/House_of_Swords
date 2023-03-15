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
                        <th scope="col" width="8%">Idő</th>
                        <th scope="col" width="20%">Email</th>
                        <th scope="col" width="30%">Hiba</th>
                        <th scope="col" width="15%">Hiba státusza</th>
                        <th scope="col" width="12%">Státusz változtatása</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $firstUntouched = -1;
                        $firstCompleted = -1;

                        foreach ($bugs as $row_id => $bug)
                        {
                            if ($bug->IsSolved == 1 && $firstUntouched == -1)
                            {
                                $firstUntouched = $row_id - 2;
                            }
                            else if ($bug->IsSolved == 2 && $firstCompleted == -1)
                            {
                                $firstCompleted = $row_id - 2;
                            }
                        }
                    @endphp

                    @foreach ($bugs as $row_id => $bug)

                        <tr id="row_{{ $row_id}}" scope="row">
                            <td id="bug_{{ $bug->Id }}">
                                {{ $bug->Id }}
                            </td>
                            <td>
                                {{ $bug->Date }}
                            </td>
                            <td>
                                @if ($bug->EmailAddress == 'anonymus')
                                    {{ $bug->EmailAddress }}
                                @else
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to={{ $bug->EmailAddress }}"
                                        target="_blank">{{ $bug->EmailAddress }}</a>
                                @endif
                            </td>
                            <td><small class="d-block">{{ $bug->Text }}</small></td>
                            @if ($bug->IsSolved == 1)
                                <td class="status"><span class="bug bug-bg">Megoldatlan</span></td>
                            @elseif ($bug->IsSolved == 0)
                                <td class="status"><span class="inprogress inprogress-bg">Folyamatban</span></td>
                            @else
                                <td class="status"><span class="fixed fixed-bg">Megoldva</span></td>
                            @endif
                            {{-- gombok, a státusz állításához --}}
                            <td class="status">
                                <div class="row mx-auto">
                                    <div class="col-1">
                                        <form action="/admin/bugreports/{{ $bug->Id }}#row_{{ $firstCompleted }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input name="IsSolved" value="2" type="text" hidden>
                                            <button type="submit" class="btn btn-sm btn-success btn-fixed"></button>
                                        </form>
                                    </div>
                                    <div class="col-1">
                                        <form action="/admin/bugreports/{{ $bug->Id }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input name="IsSolved" value="0" type="text" hidden>
                                            <button type="submit" class="btn btn-sm btn-warning btn-inprogress"></button>
                                        </form>
                                    </div>
                                    <div class="col-1">
                                        <form action="/admin/bugreports/{{ $bug->Id }}#row_{{ $firstUntouched }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input name="IsSolved" value="1" type="text" hidden>
                                            <button type="submit" class="btn btn-sm btn-danger btn-bug"></button>
                                        </form>
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
