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
                    <td>{{$participant->nev}}</td>
                    <td>{{$participant->lakcim}}</td>
                    <td>{{$participant->szuletesi_ev}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>


@endsection
