$('#btnSaveSite').on('click', function(){

    let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

    let good = true;
    let message = "";

    let tab = $('#conf_save_site').attr('data-sites');

    let sites = JSON.parse(tab);

    if(!$('#site').val().trim()){
        good = false;
        message += "Veuillez Renseigner Un Site !\n";
    }

    if(!$('#telephone').val().trim()){
        good = false;
        message += "Veuillez Renseigner Un Numéro De Téléphone !\n";
    }else{
        if(reg.test($('#telephone').val())){
        if($('#telephone').val().length == 9){
            if(parseInt($('#telephone').val().slice(0, 1)) != 6){
                good = false;
                message+="Format Du Numéro De Téléphone Incorrect !\n";            
            }else{
                let second = parseInt($('#telephone').val().slice(1, 2));
                if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                    good = false;
                    message+="Format Du Numéro De Téléphone Incorrect !\n";
                }else{
                    let yes = true;
                    sites.forEach(site => {
                        if(parseInt(site.telephoneSite) == parseInt($('#telephone').val().trim())){
                            yes = false;
                        }
                    });
                    if(!yes){
                        good = false;
                        message += "Veuillez Renseigner Un Autre Numéro De Téléphone Car Déja Existant !\n";
                    }            
                }
            }
        }else{
            good = false;
            message+="Format Du Numéro De Téléphone Incorrect !\n";        
        }
      }else{
        good = false;
        message+="Format Du Numéro De Téléphone Incorrect !\n";        
    }    
    }

    if(!$('#categorie').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Catégorie !\n";
    }
    if(!$('#region').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Région !\n";
    }

    if(!good){
        good = false;
        $('#validation').val(message);
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');
    }else{
        $('#site_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="site_conf">${$('#site').val().trim()}</span>`);
        $('#categorie_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="categorie_conf">${$("#categorie option:selected").text()}</span>`);
        $('#telephone_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="telephone_conf">${$("#telephone").val()}</span>`);
        $('#region_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="region_conf">${$("#region option:selected").text()}</span>`);
        $('#desc_conf').replaceWith(`<span style="color: black; font-size: 20px;" id="desc_conf">${$("#description").val()}</span>`);
        $('#modalConfirmationSaveSite').attr('data-backdrop', 'static');
        $('#modalConfirmationSaveSite').attr('data-keyboard', false);
        $('#modalConfirmationSaveSite').modal('show');
    }
})

$(document).on('click', '#conf_save_site', function(){
    $.ajax({
        type: 'POST',
        url: 'createSite',
        data: $('#siteFormInsert').serialize(),
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
          if(data.length == 2){
            $(this).attr('data-sites', JSON.stringify(data[1]));

            let site = data[0];
            if(site){
                $('#dataTable').prepend(`
                                <tr style="font-size:15px; color:black;">
                                    <td><label>${site.intituleSite}</label></td>
                                    <td><label> ${site.categorieSite} </label></td>
                                    <td><label> ${site.telephoneSite} </label></td>
                                    <td><label> ${site.regions.intituleRegion} </label></td>
                                    <td> 
                                        <div class='row'>
                                            <button class="btn btn-sm btn-info btn-icon-split mr-2" data-site=${site} id="btnEdit" data-id=${site.id} data-intituleSite=${site.intituleSite }>
                                                <span class="icon text-white-80">
                                                    <i class="fas fa-lg fa-building"></i>
                                                    <i class="fas fa-sm fa-pen mr-2"></i>
                                                </span>
                                                <span class="text">Editer</span>
                                            </button>

                                            <button class="btn btn-sm btn-danger btn-icon-split" id="btnDelete">
                                                <span class="icon text-white-80">
                                                    <i class="fas fa-lg fa-building"></i>
                                                    <i class="fas fa-sm fa-times"></i>
                                                </span>
                                                <span class="text">Supprimer</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                `);
               $('#siteFormInsert')[0].reset();
               $('#modalConfirmationSaveSite').modal('toggle');
            }
          }else{
            $('#validation').val('Veuillez Modifier Votre Site Car Déja Existant !');
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');    
          }
        }
    })
})

$(document).on('click', '#btnEdit', function(){

    let newSite = JSON.parse($(this).attr('data-site'));
    console.log(newSite);
    $("#siteFormEdit")[0].reset();
    
    $('.form-group #id').val(newSite.id);
    $('.form-group #sites').val(newSite.intituleSite);
    $('.form-group #telephones').val(newSite.telephoneSite);
    $('.form-group #regions').val(newSite.region_id);
    $('.form-group #categories').val(newSite.categorieSite);
    $('.form-group #descriptions').val(newSite.descriptionSite ? newSite.descriptionSite : '');
    newSite.gestionnaire == 1 ? $('.form-group #gestionnaireEdit').prop( "checked", true) : $('.form-group #gestionnaireEdit').prop( "checked", false);
    $('#modalEditSite').attr('data-backdrop', 'static');
    $('#modalEditSite').attr('data-keyboard', 'false');
    $('#modalEditSite').modal('show');
    
})


$(document).on('click', '#btnDelete', function(){
    let users = JSON.parse($(this).attr('data-users'));
    let good = true;

    users.forEach(user => {
        if(user.site_id == $(this).attr('data-id')){
            good = false;
        }
    });
    if(good){
        if(confirm("Voulez-Vous Vraiment Supprimer Ce Site "+ $(this).attr('data-intituleSite') +" ?") == true){
                $.ajax({
                    type: 'GET',
                    url: 'deleteSite',
                    data: { id: $(this).attr('data-id')},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(){
                        location.reload();
                    }
            })
        }
    }else{
        $('#validation').val("Vous Ne Pouvez Pas Supprimer Ce Site "+ $(this).attr('data-intituleSite') +" Car Il Est Associé A D'autres Modules !");
        $('#errorvalidationsModals').attr('data-backdrop', 'static');
        $('#errorvalidationsModals').attr('data-keyboard', false);
        $('#errorvalidationsModals').modal('show');        
    }
})



$('#btnEditSite').on('click', function(){

    let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

    let good = true;
    let message = "";

    let tab = $('#conf_save_site').attr('data-sites');

    let sites = JSON.parse(tab);

    if(!$('#sites').val().trim()){
        good = false;
        message += "Veuillez Renseigner Un Site !\n";
    }

    if(!$('#categories').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Catégorie !\n";
    }
    if(!$('#telephones').val().trim()){
        good = false;
        message += "Veuillez Renseigner Un Téléphone !\n";
    }else{
        if(reg.test($('#telephones').val())){
        if($('#telephones').val().length == 9){
            if(parseInt($('#telephones').val().slice(0, 1)) != 6){
                good = false;
                message+="Format Du Numéro De Téléphone Incorrect !\n";            
            }else{
                let second = parseInt($('#telephones').val().slice(1, 2));
                if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                    good = false;
                    message+="Format Du Numéro De Téléphone Incorrect !\n";
                }else{
                    let Qte = 0;
                    let array = [];
                    sites.forEach(site =>{
                        if(parseInt(site.id) != parseInt($('#id').val())){
                            array.push(site);
                        }
                    });
                    array.forEach(site => {
                        if(parseInt(site.telephoneSite) == parseInt($('#telephones').val())){
                            Qte +=1;
                        }
                    });
                    if(Qte > 0){
                        good = false;
                        message += "Veuillez Renseigner Un Autre Numéro De Téléphone Car Déja Existant !\n";
                    }            
                }
            }
        }else{
            good = false;
            message+="Format Du Numéro De Téléphone Incorrect !\n";        
        }
      }else{
        good = false;
        message+="Format Du Numéro De Téléphone Incorrect !\n";        
      }
    }
    if(!$('#regions').val().trim()){
        good = false;
        message += "Veuillez Renseigner Une Région !\n";
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
                url: 'editSite',
                data: $('#siteFormEdit').serialize(),
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.length == 1){
                        $('#siteFormEdit')[0].reset();
                        location.reload();
                    }else{
                        alert("Veuillez Modifier Votre Site Car Déja Existant !");
                    }
                }
            })
    }
})

$(document).on('click', '#btnClose', function(){
    location.reload();
});

$(function() { 
    $('#btnClose, #btnExit').click(function() { 
        $('#siteFormInsert')[0].reset();
    }); 
}); 

$(document).ready(function(){
    $('#btnExit_site').on('click', function(){
        $('#siteFormEdit')[0].reset();
    });
})