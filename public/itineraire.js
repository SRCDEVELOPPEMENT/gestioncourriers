$(document).on('click', '#setItineraireMainPage', function(){
    let good = true;
    let message = "";

    if(!$('#lieux_depart_Main').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux De Départ !\n";
    }

    if(!$('#lieux_arrivee_Main').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux D'arrivé !\n";
    }

    if(!$('#duree_Main').val().trim()){
        good = false;
        message+="Veuillez Renseigner Une Durée !\n";
    }

    if(!good){
        $('#validationsMainPage').val(message);
        $('#errorvalidationsMainPage').attr('data-backdrop', 'static');
        $('#errorvalidationsMainPage').attr('data-keyboard', false);
        $('#errorvalidationsMainPage').modal('show');
    }else{
        $('#lieux_depart_conf_Main').replaceWith(`<span style="color: black; font-size: 15px;" id="lieux_depart_conf_Main">${$('#lieux_depart_Main').val()}</span>`);
        $('#lieux_arrive_conf_Main').replaceWith(`<span style="color: black; font-size: 15px;" id="lieux_arrive_conf_Main">${$('#lieux_arrivee_Main').val()}</span>`);
        $('#duree_itineraire_conf_Main').replaceWith(`<span style="color: black; font-size: 15px;" id="duree_itineraire_conf_Main">${$('#duree_Main').val()}</span>`);
        
        $('#modalConfirmMainPage').attr('data-backdrop', 'static');
        $('#modalConfirmMainPage').attr('data-keyboard', false);
        $('#modalConfirmMainPage').modal('show');
    }
});

$(document).on('click', '#conf_MainPage_Itin', function(){
    $.ajax({
        type: 'POST',
        url: "createItineraireMainPage",
        data: $('#ItineraireForm').serialize(),
        headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success: function(){
            $('#ItineraireForm')[0].reset();
            $('#modalConfirmMainPage').modal('toggle');
        }
    });
});


$(document).on('click', '#setItineraire', function(){
    let good = true;
    let message = "";

    if(!$('#lieux_depart_index').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux De Départ !\n";
    }

    if(!$('#lieux_arrivee_index').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux D'arrivé !\n";
    }

    if(!$('#duree_index').val().trim()){
        good = false;
        message+="Veuillez Renseigner Une Durée !\n";
    }

    if(!good){
        $('#validationsIndexItine').val(message);
        $('#errorvalidationsItinePage').attr('data-backdrop', 'static');
        $('#errorvalidationsItinePage').attr('data-keyboard', false);
        $('#errorvalidationsItinePage').modal('show');
    }else{
        $('#lieux_depart_conf_index').replaceWith(`<span style="color: black; font-size: 15px;" id="lieux_depart_conf_index">${$('#lieux_depart_index').val()}</span>`);
        $('#lieux_arrive_conf_index').replaceWith(`<span style="color: black; font-size: 15px;" id="lieux_arrive_conf_index">${$('#lieux_arrivee_index').val()}</span>`);
        $('#duree_itineraire_conf_index').replaceWith(`<span style="color: black; font-size: 15px;" id="duree_itineraire_conf_index">${$('#duree_index').val()}</span>`);
        
        $('#modalSavingIndexPage').attr('data-backdrop', 'static');
        $('#modalSavingIndexPage').attr('data-keyboard', false);
        $('#modalSavingIndexPage').modal('show');
    }
});

$(document).on('click', '#conf_indexPage', function(){
    $.ajax({
        type: 'POST',
        url: "createItineraireItinPage",
        data: $('#ItineraireFormIndexPage').serialize(),
        headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success: function(itineraire){
            if(itineraire){
                $('#dataTable').append(`
                    <tr style="font-size:20px; color:black;">
                        <td><label style="font-size:1.1em;"> ${itineraire.lieux_depart} </label></td>
                        <td><label> ${itineraire.lieux_arrivee} </label></td>
                        <td><label> ${itineraire.duree} </label></td>
                        <td>
                            <?php @can('editer-itineraire') ?>
                            <button class="btn btn-sm btn-info mr-1"
                                    title="Edition" 
                                    id="btnEdit"
                                    name="btnItineraire"
                                    data-toggle="modal"
                                    data-target="#edit"
                                    data-backdrop="static"
                                    data-keyboard="false"
                                    >
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-road"></i>
                                        <i class="fas fa-pen" style="font-size:13px;"></i>
                                    </span>
                            </button>
                            <?php @endcan ?>
                            <?php @can('supprimer-itineraire') ?>
                            <button class="btn btn-sm btn-danger mr-1"
                                    name="btnDelete" 
                                    title="Annuler" 
                                    >
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-road"></i>
                                        <i class="fas fa-times" style="font-size:13px;"></i>
                                    </span>
                            </button>
                            <?php @endcan ?>
                        </td>
                    </tr>
                `);

                $('#ItineraireFormIndexPage')[0].reset();
                $('#modalSavingIndexPage').modal('toggle');
            }
        }
    });
});

$(document).on('click', 'button[name="btnDeleteItineraire"]', function(){
    let courriers = JSON.parse($(this).attr('data-courriers'));
    var itineraire = JSON.parse($(this).attr('data-itineraire'));

    let elt = courriers.find(courrier => parseInt(courrier.itineraire) == parseInt(itineraire.id));

    if(!elt){
        if(confirm('Voulez-vous Vraiment Supprimer Cette Itinéraire : '+ itineraire.lieux_depart +'-'+ itineraire.lieux_arrivee +'-'+ itineraire.duree +'  ?') == true){
            $.ajax({
                type: 'POST',
                url: 'deleteItineraire',
                data: {id: itineraire.id},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(){
                    location.reload();
                }
            })
        }
    }else{
        alert("Vous Ne Pouvez Pas Supprimer Cette Itinéraire Car Il Est Associer A Un Courrier !");
    }
});


$(document).on('click', 'button[name="btnItineraireEdit"]', function(){
    var itineraire = JSON.parse($(this).attr('data-itineraire'));
    $('#id').val(itineraire.id);
    $('#lieux_depart_index_edit').val(itineraire.lieux_depart);
    $('#lieux_arrivee_index_edit').val(itineraire.lieux_arrivee);
    $('#duree_index_edit').val(itineraire.duree);
});


$(document).on('click', '#EditItineraire', function(){
    let good = true;
    let message = "";

    if(!$('#lieux_depart_index_edit').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux De Départ !\n";
    }

    if(!$('#lieux_arrivee_index_edit').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Lieux D'arrivé !\n";
    }

    if(!$('#duree_index_edit').val().trim()){
        good = false;
        message+="Veuillez Renseigner Une Durée !\n";
    }
    
    if(!good){
        $('#validationsIndexItine').val(message);
        $('#errorvalidationsItinePage').attr('data-backdrop', 'static');
        $('#errorvalidationsItinePage').attr('data-keyboard', false);
        $('#errorvalidationsItinePage').modal('show');
    }else{
        $.ajax({
            type: 'PUT',
            url: "updateItineraire",
            data: $('#ItineraireFormIndexPageEdit').serialize(),
            headers:{
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(){
                 location.reload();
             }
        });
    }
});


$(document).on('click', '#btnExit_itineraire', function(){
    location.reload();
});