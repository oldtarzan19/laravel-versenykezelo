jQuery(document).ready(function($){
    //----- Verseny létrehozása div megynitása -----//
    jQuery('#btn-add-competition').click(function () {
        jQuery('#btn-save-competition').val("add-competition");
        jQuery('#addCompetitionForm').trigger("reset");
        jQuery('#competitionFormModal').modal('show');
    });
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
                jQuery('#competitionFormModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
