@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Versenykezelő</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                @if(Auth::check() && Auth::user()->email === 'admin@admin.com')
                    <button class="btn btn-success" id="btn-add-competition">
                        Verseny hozzáadása
                    </button>

                    <button class="btn btn-primary" id="btn-add-round">
                        Forduló hozzáadása
                    </button>

                @endif

                @if(!Auth::check())
                    <a href="{{ route('register') }}" class="btn btn-primary">Regisztráció/Bejelentkezés</a>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-danger">Kijelentkezés</a>
                @endif

            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>Verseny neve</th>
                    <th>Év</th>
                    <th>Elérhető nyelvek</th>
                    <th>Pontok jó</th>
                    <th>Pontok rossz</th>
                    <th>Pontok üres</th>
                </tr>
                </thead>
                <tbody id="competition-list" name="competition-list">

                @foreach ($competitions as $competition)
                    <tr id="competition{{$competition->id}}">
                        <td>{{$competition->nev}}</td>
                        <td>{{$competition->ev}}</td>
                        <td>{{$competition->elerheto_nyelvek}}</td>
                        <td>{{$competition->pontok_jo}}</td>
                        <td>{{$competition->pontok_rossz}}</td>
                        <td>{{$competition->pontok_ures}}</td>
                    </tr>

                    @foreach ($competition->rounds as $round)
                        <tr id="round{{$round->id}}">
                            <td colspan="6" class="pl-5 py-2">
                                <b>Forduló neve:</b> {{$round->nev}}, Dátum: {{$round->datum}},
                            </td>
                            <td>
                                <a href="participants/{{$round->id}}" class="btn btn-primary">Résztvevők</a>
                            </td>

                            @if(Auth::check() && Auth::user()->email === 'admin@admin.com')
                                <td>
                                    <button class="btn btn-primary btn-add-participant" data-round-id="{{ $round->id }}">
                                        Versenyző hozzáadása
                                    </button>
                                </td>

                            @endif

                        </tr>
                    @endforeach
                @endforeach

                </tbody>
            </table>
            {{--Új verseny hozzáadása DIV--}}
            <div class="modal fade" id="competitionFormModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Verseny hozzáadása</h4>
                        </div>
                        <div class="modal-body">
                            <form id="addCompetitionForm" name="addCompetitionForm" class="form-horizontal" novalidate="">

                                <div class="form-group">
                                    <label for="verseny_nev">Név</label>
                                    <input type="text" class="form-control" id="verseny_nev" name="verseny_nev"
                                           placeholder="Add meg a vereseny nevét" value="">
                                </div>

                                <div class="form-group">
                                    <label for="competition_year">Verseny éve</label>
                                    <input type="text" class="form-control" id="competition_year" name="competition_year"
                                           placeholder="Add meg a verseny évét" value="">
                                </div>

                                <div class="form-group">
                                    <label for="available_languages">Elérhető nyelvek</label>
                                    <input type="text" class="form-control" id="available_languages" name="available_languages"
                                           placeholder="Add meg az elérhető nyelveket, vesszővel elválasztva" value="">
                                </div>

                                <div class="form-group">
                                    <label for="points_correct">Pontok jó válasz esetén</label>
                                    <input type="number" class="form-control" id="points_correct" name="points_correct"
                                           placeholder="Add meg a pontok számát jó válasz esetén" value="">
                                </div>

                                <div class="form-group">
                                    <label for="points_wrong">Pont levonás rossz válasz esetén</label>
                                    <input type="number" class="form-control" id="points_wrong" name="points_wrong"
                                           placeholder="Add meg a levonandó pontok számát rossz válasz esetén" value="">
                                </div>

                                <div class="form-group">
                                    <label for="points_empty">Pont levonás üres válasz esetén</label>
                                    <input type="number" class="form-control" id="points_empty" name="points_empty"
                                           placeholder="Add meg a levonandó pontok számát üres válasz esetén" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save-competition" value="add">Verseny hozzáadása
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{--Új forduló hozzáadása DIV--}}
            <div class="modal fade" id="roundFormModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formModalLabel">Forduló hozzáadása</h4>
                        </div>
                        <div class="modal-body">
                            <form id="addRoundForm" name="addRoundForm" class="form-horizontal" novalidate="">

                                <div class="form-group">
                                    <label for="versenyek_select">Verseny kiválasztása</label>
                                    <select class="form-control" name="versenyek_select" id="versenyek_select">
                                        @foreach ($competitions as $verseny)
                                            <option value="{{ $verseny->id }}">
                                                {{ $verseny->nev }} ({{ $verseny->ev }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="fordulo_name">Név</label>
                                    <input type="text" class="form-control" id="fordulo_name" name="fordulo_name"
                                           placeholder="Add meg a forduló nevét" value="">
                                </div>

                                <div class="form-group">
                                    <label for="round_date">Round Date</label>
                                    <input type="date" class="form-control" id="round_date" name="round_date"
                                           placeholder="Enter the round date" value="">
                                </div>



                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save-round" value="add">Forduló hozzáadása
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{--Új versenyző hozzáadása fordulóhoz DIV--}}

            <div class="modal fade" id="participantFormModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="formParticipantLabel">Versenyző hozzáadása a fordulóhoz</h4>
                        </div>
                        <div class="modal-body">
                            <form id="addParticipantForm" name="addParticipantForm" class="form-horizontal" novalidate="">

                                <div class="form-group">
                                    <label for="user_select">Versenyző kiválasztása</label>
                                    <select class="form-control" name="user_select" id="user_select">
                                        @foreach($users as $user)

                                            <option value="{{ $user->id }}">
                                                {{ $user->nev }}
                                            </option>

                                        @endforeach
                                    </select>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save-participant" value="add">Forduló hozzáadása
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/async.js') }}" defer></script>
@endsection
