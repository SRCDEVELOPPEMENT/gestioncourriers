$('#btnSaveVehicule').on('click', function(){

    let vehicules = JSON.parse($('#conf_save_vehicule').attr('data-vehicules'));

    let good = true;
    let message = "";

    if(!$('#Immatriculation').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Immatriculation !\n";
    }
    
    if(!$('#MarqueVehicule').val().trim()){
        good = false;
        message += "Veuillez Renseigner La Marque Du Véhicule !\n";
    }
    if(!$('#StatutVehicule').val().trim()){
        good = false;
        message += "Veuillez Renseigner Le Statut Du Véhicule !\n";
    }
    if(!good){
        good = false;
        $('#validation').val(message);
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');
    }else{
        $('#immatriculation_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="immatriculation_conf">${$('#Immatriculation').val().trim()}</span>`);
        $('#num_serie_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="num_serie_conf">${$("#NumeroSerie").val()}</span>`);
        $('#marque_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="marque_conf">${$("#MarqueVehicule").val()}</span>`);
        $('#statut_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="statut_conf">${$("#StatutVehicule option:selected").text()}</span>`);
        $('#modalVehiculeConfirm').attr('data-backdrop', 'static');
        $('#modalVehiculeConfirm').attr('data-keyboard', false);
        $('#modalVehiculeConfirm').modal('show');
    }
})


$(document).on('click', '#conf_save_vehicule', function(){
    $.ajax({
        type: 'POST',
        url: "createVehicule",
        data: $('#vehiculeFormInsert').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if(data.length == 2){
                $(this).attr('data-vehicules', JSON.stringify(data[1]))
                let vehicule = data[0];

                if(vehicule){
                    $('#dataTable').prepend(`
                                    <tr style="font-size:15px; color:black;">
                                        <td><label>${vehicule.Immatriculation}</label></td>
                                        <td><label>${vehicule.MarqueVehicule}</label></td>
                                        <td><label>${vehicule.StatutVehicule}</label></td>
                                        <td><label>${vehicule.NumeroSerie ? vehicule.NumeroSerie : ''}</label></td>
                                        <td> 
                                            <div class='row row ml-3'>
                                                <button class="btn btn-info" id="btnEdit" type="button" 
                                                data-id=${vehicule.id} 
                                                data-Immatriculation=${vehicule.Immatriculation} 
                                                data-MarqueVehicule=${vehicule.MarqueVehicule} 
                                                data-StatutVehicule=${vehicule.StatutVehicule} 
                                                data-NumeroSerie=${vehicule.NumeroSerie ? vehicule.NumeroSerie : ''}><span class="icon text-white-80"><i class="fas fa-edit"></i></span></button>    
                                                
                                                <button class="btn btn-sm btn-info btn-icon-split mr-2" id="btnEdit" data-id=${vehicule.id} data-Immatriculation=${vehicule.Immatriculation}  data-MarqueVehicule=${vehicule.MarqueVehicule} data-StatutVehicule=${vehicule.StatutVehicule} data-NumeroSerie=${vehicule.NumeroSerie}>
                                                    <span class="icon text-white-80">
                                                        <i class="fas fa-lg fa-truck"></i>
                                                        <i class="fas fa-sm fa-pen"></i>
                                                    </span>
                                                    <span class="text">Editer</span>
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-icon-split" id="btnDelete" data-Immatriculation=${vehicule.Immatriculation} data-id=${vehicule.id}>
                                                    <span class="icon text-white-80">
                                                        <i class="fas fa-lg fa-truck"></i>
                                                        <i class="fas fa-sm fa-times"></i>
                                                    </span>
                                                    <span class="text">Supprimer</span>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                    `);
                $('#vehiculeFormInsert')[0].reset();
                $('#modalVehiculeConfirm').modal('toggle');
                }
           }else{
            $('#validation').val('Veuillez Modifier Votre Véhicule Car Déja Existant !');
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');    
            }
        }
    })
});

$(document).on('click', '#btnAddCarToPersonne', function(){
    let good = true;
    let message = "";

    if(!$('#vehicule').val().trim()){
        good = false;
        message += "Veuillez Selectionner Un Véhicule !\n";
    }
    if(!$('#chauffeur').val().trim()){
        good = false;
        message += "Veuillez Selectionner Un Chauffeur !\n";
    }
    if(!good){
        good = false;
        $('#validation').val(message);
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');
    }else{
        $.ajax({
            type: 'POST',
            url: 'affectCarToPersonne',
            data: $('#AddPersontoCarFormInsert').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(){
                location.reload();
            }
        })
    }
})

$(document).on('click', '#btnEdit', function(){

    let id = $(this).attr('data-id');
    let Immatriculation = $(this).attr('data-Immatriculation');
    let MarqueVehicule = $(this).attr('data-MarqueVehicule');
    let StatutVehicule = $(this).attr('data-StatutVehicule');
    let NumeroSerie = $(this).attr('data-NumeroSerie');

    $('.form-group #id').val(id);
    $('.form-group #Immatriculations').val(Immatriculation);
    $('.form-group #MarqueVehicules').val(MarqueVehicule);
    $('.form-group #StatutVehicules').val(StatutVehicule);
    $('.form-group #NumeroSeries').val(NumeroSerie);

    $('#modalEditvehicule').attr('data-backdrop', 'static');
    $('#modalEditvehicule').attr('data-keyboard', 'false');
    $('#modalEditvehicule').modal('show');

})

$(document).on('click', '#btnDelete', function(){
    let personnes = JSON.parse($(this).attr("data-personnes"));
    let good = true;
    personnes.forEach(personne => {
        if(personne.vehicule_id == parseInt($(this).attr('data-id'))){
            good = false;
        }
    });
    if(!good){
        $('#validation').val("Vous Ne Pouvez Pas Supprimer Ce Vehicule "+ $(this).attr('data-Immatriculation') +" Car Il Est Associé A Un Chauffeur !");
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');        
    }else{
        if(confirm("Voulez-Vous Vraiment Supprimer Ce Véhicule : "+ $(this).attr('data-Immatriculation') +" ?") == true){
                $.ajax({
                    type: 'GET',
                    url: 'deleteVehicule',
                    data: { id: $(this).attr('data-id')},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(){
                        location.reload();
                    }
            })
        }
    }
})


$('#btnEditVehicule').on('click', function(){

    let vehicules = JSON.parse($('#conf_save_vehicule').attr('data-vehicules'));

    let good = true;
    let message = "";

    if(!$('#Immatriculations').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Immatriculation !\n";
    }else{
        let Qte = 0;
        let array = [];
        
        vehicules.forEach(vehicule =>{
            if(parseInt(vehicule.id) != parseInt($('#id').val())){
                array.push(vehicule);
            }
        });
        array.forEach(vehicule => {
            if(vehicule.Immatriculation.trim() == $('#Immatriculations').val().trim()){
                Qte +=1;
            }
        });
        if(Qte > 0){
            good = false;
            message += "Veuillez Modifier Votre Immatriculation Car Déja Existant !\n";
        }    
    }
    if(!$('#MarqueVehicules').val().trim()){
        good = false;
        message += "Veuillez Renseigner La Marque Du Véhicule !\n";
    }
    if(!$('#StatutVehicules').val().trim()){
        good = false;
        message += "Veuillez Renseigner Le Statut Du Véhicule !\n";
    }
        
    if(!good){
            good = false;
            $('#validation').val(message);
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');
    }else{
            $.ajax({
                type: 'POST',
                url: 'editVehicule',
                data: $('#vehiculeFormEdit').serialize(),
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.length == 1){
                        location.reload();
                    }else{
                        $('#validation').val('Veuillez Modifier Votre Immatriculation Car Déja Existant !');
                        $('#errorvalidationsModals').attr('data-backdrop', 'static');
                        $('#errorvalidationsModals').attr('data-keyboard', false);
                        $('#errorvalidationsModals').modal('show');
                    }
                }
            })
        }
})


$('#btnReset').on('click', function(){
    $('#vehiculeFormInsert')[0].reset();
})

$('#btnExit').on('click', function(){
    $('#AddPersontoCarFormInsert')[0].reset();
})

$(document).on('click', '#btnClear', function(){
    $('#vehiculeFormEdit')[0].reset();
})

$(document).ready(function(){
    $('#poste').on("input", function(){
        
        let poste_id = $('#poste').val();
        let personnes = JSON.parse($(this).attr('data-personnes'));

        $('select[name="chauffeur_id"]').find('option').remove().end();
        $('select[name="chauffeur_id"]').append(`<option value="">Selectionnez Une Personne</option>`)
        personnes.forEach(personne => {
            if(personne.poste_id == parseInt(poste_id)){
                $('select[name="chauffeur_id"]').append(`
                <option value="${personne.id}">${personne.fullname}</option>
                `)
            }
        });
    })
})

$(document).on('click', '#btnClose', function(){
    location.reload();
});