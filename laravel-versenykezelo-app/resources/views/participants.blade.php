@extends('layouts.app')
@section('content')
    @if($round->participants->count() == 0)
        <div class="alert alert-danger">
            <strong>Nincs még versenyző!</strong>
        </div>

    @else
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
                    <tr id="participant-{{$participant->id}}">
                        <td>{{$participant->user->nev}}</td>
                        <td>{{$participant->user->lakcim}}</td>
                        <td>{{$participant->user->szuletesi_ev}}</td>
                        <td>
                            <button class="btn btn-danger delete-participant" data-id="{{$participant->id}}">Törlés</button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


        </div>
    @endif
@endsection
