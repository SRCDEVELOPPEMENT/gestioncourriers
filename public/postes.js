$('#btnAddPoste').on('click', function(){

    let good = true;
    let message = "";

    let tab = $("#conf_save_poste").attr('data-postes');

    let postes = JSON.parse(tab);

    if(!$('#poste').val().trim()){
    good = false;
    message+="Veuillez Renseigner Un Poste !\n";
    }

    if(!good){
        good = false;
        $('#validation').val(message);
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');
    }else{
        $('#poste_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="poste_conf">${$('#poste').val().trim()}</span>`);
        $('#desc_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="desc_conf">${$("#Description").val()}</span>`);
        $('#modalConfirmationPoste').attr('data-backdrop', 'static');
        $('#modalConfirmationPoste').attr('data-keyboard', false);
        $('#modalConfirmationPoste').modal('show');
    }    
});

$(document).on('click', '#conf_save_poste', function(){
    $.ajax({
        type: 'POST',
        url: 'createPoste',
        data: $('#posteFormInsert').serialize(),
         headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success: function(data){
            if(data.length == 2){
            $(this).attr('data-postes', JSON.stringify(data[1]));

            let poste = data[0];

            if(poste){
                $('#dataTable').prepend(`
                <tr style="font-size:15px; color:black;">
                    <td><label>${poste.intitulePoste}</label></td>
                    <td> ${poste.descriptionPoste ? poste.descriptionPoste : ''} </td>
                    <td> 
                        <div class='row'>
                            <button class="btn btn-sm btn-info btn-icon-split mr-2" id="btnEdit" data-id=${poste.id} data-intitulePoste=${poste.intitulePoste}  data-descriptionPoste=${poste.descriptionPoste}>
                                <span class="icon text-white-80">
                                    <i class="fas fa-lg fa-toolbox"></i>
                                    <i class="fas fa-sm fa-pen"></i>
                                </span>
                                <span class="text">Editer</span>
                            </button>
                            <button class="btn btn-sm btn-danger btn-icon-split" id="btnDelete" data-intitulePoste=${poste.intitulePoste} data-id=${poste.id}>
                                <span class="icon text-white-80">
                                    <i class="fas fa-lg fa-toolbox"></i>
                                    <i class="fas fa-sm fa-times mr-2"></i>
                                </span>
                                <span class="text">Supprimer</span>
                            </button>
                        </div>
                    </td>
                </tr>
                `)
                $("#posteFormInsert")[0].reset();
                $('#modalConfirmationPoste').modal('toggle');
            }
           }else{
               alert(data[0])
           }
          }                
    })
})

$(document).on('click', '#btnEdit', function(){

    let id = $(this).attr('data-id');
    let poste = $(this).attr('data-intitulePoste');
    let description = $(this).attr('data-descriptionPoste') ? $(this).attr('data-descriptionPoste') : '';


    $("#posteFormEdit")[0].reset();
    
    $('.form-group #id').val(id);
    $('.form-group #postes').val(poste);
    $('.form-group #Descriptions').val(description ? description : '');
    
    $('#modalEditposte').attr('data-backdrop', 'static');
    $('#modalEditposte').attr('data-keyboard', 'false');
    $('#modalEditposte').modal('show');

})


$('#btnEditposte').on('click', function(){

    let good = true;
    let message = "";

    if(!$('#postes').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Poste !\n";
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
                url: 'editPoste',
                data: $('#posteFormEdit').serialize(),
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.length == 1){
                        location.reload();
                    }else{
                        $('#validation').val('Veuillez Modifier Votre Poste Car Déja Existant !');
                        $('#errorvalidationsModals').attr('data-backdrop', 'static');
                        $('#errorvalidationsModals').attr('data-keyboard', false);
                        $('#errorvalidationsModals').modal('show');                
                    }
                }
            })
        }
})


$(document).on('click', '#btnDelete', function(){
    if(confirm("Voulez-Vous Vraiment Supprimer Ce Poste : "+ $(this).attr('data-intitulePoste') +" ?") == true){
            $.ajax({
                type: 'GET',
                url: 'deletePoste',
                data: { id: $(this).attr('data-id')},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(){
                    location.reload();
                }
        })
    }
})

$(document).on('click', '#btnClose', function(){
    location.reload();
});

$(function() { 
    $('#btnExit').click(function() { 
        $('#posteFormInsert')[0].reset();
    }); 
}); 