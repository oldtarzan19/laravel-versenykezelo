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

    //----- Kilépés -----//
    jQuery('#logout-button').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var type = "POST";
        var ajaxurl = 'logout';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: {logout: 'logout'},
            dataType: 'json',
            success: function (data) {
                console.log("Sikeres kijelentkezés");

                location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    var round_id = -1;

    //----- Versenyző hozzáadása fordulóhoz div megynitása -----//
    jQuery(document).on('click', '.btn-add-participant', function () {
        jQuery('#btn-save-participant').val("add-participant");
        jQuery('#addParticipantForm').trigger("reset");
        jQuery('#participantFormModal').modal('show');
        round_id = jQuery(this).data('round-id');
    });

    // Fordulo hozzáadása gomb megjenítése vagy eltünteése ha nincs verseny az adatbázisban
    if(jQuery('#competition-list tr').length === 0){
        jQuery('#btn-add-round').hide();
    }


    // Verseny hozzádaása
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
                var round = '<tr id="round' + data.id + '"><td colspan="6" class="pl-5 py-2"><b>Forduló neve:</b> ' + data.nev + ', Dátum: ' + data.datum + '</td><td><a href="participants/'+ data.id +'" class="btn btn-primary">Résztvevők</a></td><td><button class="btn btn-primary btn-add-participant" data-round-id="'+data.id +'">Versenyző hozzáadása</button></td></tr>';
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


    $("#btn-save-participant").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            fordulo_id: round_id,
            felhasznalo_id: jQuery('#user_select').val(),
        };
        var type = "POST";
        var ajaxurl = 'round_participant';
        var state = jQuery('#btn-save-participant').val();
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                /*var participant = '<tr id="participant' + data.id + '"><td>' + data.nev + '</td><td>' + data.pontszam + '</td></tr>';
                if (state === "add-participant") {
                    jQuery('#participant-list').append(participant);
                } else {
                    $("#participant" + data.id).replaceWith(participant);
                }*/
                jQuery('#addParticipantForm').trigger("reset");
                jQuery('#participantFormModal').modal('hide');

            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    $(document).on('click', '.delete-participant', function () {
        var participantId = $(this).data('id');
        var url = '/delete_participant';

        $.ajax({
            type: 'DELETE',
            url: url,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': participantId
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Assuming the server responds with the deleted participant data
                console.log('Participant deleted successfully');

                // Remove the participant row from the table
                $('#participant-' + participantId).remove();
            },
            error: function (data) {
                console.error('Error deleting participant:', data);
            }
        });
    });

//----- Login form  -----//


    $('#loginForm').on('submit', function(e){
        e.preventDefault();

        var email = $('#login_email').val();
        var password = $('#login_password').val();

        $.ajax({
            url: '/login',
            type: 'POST',
            data: {
                login_email: email,
                login_password: password
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response === 'success'){
                    window.location.href = '/';
                }
            },
            error: function(){
                alert('Hibás email vagy jelszó!');
            }
        });
    });


    //----- Register form  -----//

    $('#registerForm').on('submit', function(e){
        e.preventDefault();

        var nev = $('#nev').val();
        var email = $('#email').val();
        var telefonszam = $('#telefonszam').val();
        var lakcim = $('#lakcim').val();
        var szuletesi_ev = $('#szuletesi_ev').val();
        var jelszo = $('#jelszo').val();
        var jelszo_confirmation = $('#jelszo_confirmation').val();

        $.ajax({
            url: '/register',
            type: 'POST',
            data: {
                nev: nev,
                email: email,
                telefonszam: telefonszam,
                lakcim: lakcim,
                szuletesi_ev: szuletesi_ev,
                password: jelszo,
                password_confirmation: jelszo_confirmation
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(){
                window.location.href = '/';
            },
            error: function(xhr){
                alert(xhr.responseText);
            }
        });
    });



});
