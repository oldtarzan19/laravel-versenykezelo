jQuery(document).ready(function($){
    //----- Verseny létrehozása div megynitása -----//
    jQuery('#btn-add-competition').click(function () {
        jQuery('#btn-save-competition').val("add-competition");
        jQuery('#addCompetitionForm').trigger("reset");
        jQuery('#competitionFormModal').modal('show');
    });

    //----- Forduló létrehozása div megynitása -----//
    jQuery('#btn-add-round').click(function () {
        jQuery('#btn-save-round').val("add-round");
        jQuery('#addRoundForm').trigger("reset");
        jQuery('#roundFormModal').modal('show');
    });

    // Fordulo hozzáadása gomb megjenítése vagy eltünteése ha nincs verseny az adatbázisban
    if(jQuery('#competition-list tr').length === 0){
        jQuery('#btn-add-round').hide();
    }


    // Verseny create
    $("#btn-save-competition").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            nev: jQuery('#verseny_nev').val(),
            ev: jQuery('#competition_year').val(),
            elerheto_nyelvek: jQuery('#available_languages').val(),
            pontok_jo: jQuery('#points_correct').val(),
            pontok_rossz: jQuery('#points_wrong').val(),
            pontok_ures: jQuery('#points_empty').val(),
        };
        var type = "POST";
        var ajaxurl = 'competition';
        var state = jQuery('#btn-save-competition').val();
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var competition = '<tr id="competition' + data.id + '"><td>' + data.nev + '</td><td>' + data.ev + '</td><td>' + data.elerheto_nyelvek + '</td><td>' + data.pontok_jo + '</td><td>' + data.pontok_rossz + '</td><td>' + data.pontok_ures + '</td></tr>';
                if (state === "add-competition") {
                    jQuery('#competition-list').append(competition);
                } else {
                    $("#competition" + data.id).replaceWith(competition);
                }
                jQuery('#addCompetitionForm').trigger("reset");
                jQuery('#competitionFormModal').modal('hide');
                jQuery('#btn-add-round').show();

                // Versenyek select frissítése
                var newOption = '<option value="' + data.id + '">' + data.nev + ' (' + data.ev + ')</option>';
                jQuery('select[name="versenyek_select"]').append(newOption);


            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // Forduló hozzádaása
    $("#btn-save-round").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            verseny_id: jQuery('#versenyek_select').val(),
            nev: jQuery('#fordulo_name').val(),
            datum: jQuery('#round_date').val(),
        };
        var type = "POST";
        var ajaxurl = 'round';
        var state = jQuery('#btn-save-round').val();
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var round = '<tr id="round' + data.id + '"><td colspan="6" class="pl-5 py-2">Forduló neve: ' + data.nev + ', Dátum: ' + data.datum + '</td><td><a href="participants/{{$round->id}}" class="btn btn-primary">Résztvevők</a></td></tr>';
                if (state === "add-round") {
                    jQuery('#competition' + data.verseny_id).after(round);
                } else {
                    $("#round" + data.id).replaceWith(round);
                }
                jQuery('#addRoundForm').trigger("reset");
                jQuery('#roundFormModal').modal('hide');

            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
