@extends('layouts.app')
@section('content')

    <div>
        <table class="table table-inverse">
            <thead>
            <tr>
                <th>Név</th>
                <th>Lakcím</th>
                <th>Születési év</th>
            </tr>
            </thead>
            <tbody id="competition-list" name="competition-list">

            @foreach ($round->participants as $participant)
                <tr>
                    <td>{{$participant->user->nev}}</td>
                    <td>{{$participant->user->lakcim}}</td>
                    <td>{{$participant->user->szuletesi_ev}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>


    </div>


@endsection
