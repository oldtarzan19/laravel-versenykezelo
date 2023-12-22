@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex bd-highlight mb-4">
            <div class="p-2 w-100 bd-highlight">
                <h2>Versenykezelő</h2>
            </div>
            <div class="p-2 flex-shrink-0 bd-highlight">
                <button class="btn btn-success" id="btn-add-competition">
                    Verseny hozzáadása
                </button>


                <button class="btn btn-primary" id="btn-add-round">
                    Forduló hozzáadása
                </button>

            </div>
        </div>
        <div>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>Név</th>
                    <th>Év</th>
                    <th>Elérhető nyelvek</th>
                    <th>Pontok jó</th>
                    <th>Pontok rossz</th>
                    <th>Pontok üres</th>
                </tr>
                </thead>
                <tbody id="competition-list" name="competition-list">
                @foreach ($competitions as $data)
                    <tr id="$competition{{$data->id}}">
                        <td>{{$data->nev}}</td>
                        <td>{{$data->ev}}</td>
                        <td>{{$data->elerheto_nyelvek}}</td>
                        <td>{{$data->pontok_jo}}</td>
                        <td>{{$data->pontok_rossz}}</td>
                        <td>{{$data->pontok_ures}}</td>

                    </tr>
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
                            <button type="button" class="btn btn-primary" id="btn-save-round" value="add">Verseny hozzáadása
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
