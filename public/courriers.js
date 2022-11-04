$(document).ready(function(){
    $('#btnAddCourrier').on('click', function(){
        
        let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

        let good = true;
        let message = "";

        let tab = $("#conf_save_courrier").attr('data-personnes');
        
        let personnes = JSON.parse(tab);

        if(!$('#TypeCourrier').val().trim()){
        good = false;
        message+="Veuillez Selectionner Un Type De Courrier !\n";
        }

        if(!$('#TypeEnvoie').val().trim()){
            good = false;
            message+="Veuillez Selectionner Un Type D'envoit !\n";
        }

        if($('#fullname_destinateur').val().trim()){
            if(!$('#phone_desti').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone Du Destinateur Du Courrier !\n";  
            }else{
                if(reg.test($('#phone_desti').val())){
                    if($('#phone_desti').val().length == 9){
                        if(parseInt($('#phone_desti').val().slice(0, 1)) != 6){
                            good = false;
                            message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";            
                        }else{
                            let second = parseInt($('#phone_desti').val().slice(1, 2));
                            if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                                good = false;
                                message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";
                            }
                            // else{
                            //     let oui = true;
                            //     personnes.forEach(personne => {
                            //         if(parseInt(personne.telephone) == parseInt($('#phone_desti').val())){
                            //             oui = false;
                            //         }
                            //     });
                            //     if(!oui){
                            //         good = false;
                            //         message+="Veuillez Changer Le Numéro De Téléphone Du Destinateur Car Déja Existant !\n";    
                            //     }            
                            // }
                        }
                    }else{
                        good = false;
                        message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";        
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";
                }
            }
        }else{
            if($('#phone_desti').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Destinateur Du Courrier !\n";    
            }
        }
    
        if($('#destinateur').val().trim()){
            if(!$('#telephone_destinateur').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone De L'expéditeur Du Courrier !\n";    
            }else{
                if(reg.test($('#telephone_destinateur').val())){
                    if($('#telephone_destinateur').val().length == 9){
                        if(parseInt($('#telephone_destinateur').val().slice(0, 1)) != 6){
                            good = false;
                            message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";            
                        }else{
                            let second = parseInt($('#telephone_destinateur').val().slice(1, 2));
                            if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                                good = false;
                                message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";
                            }
                            // else{
                            //     let oui = true;
                            //     personnes.forEach(personne => {
                            //         if(parseInt(personne.telephone) == parseInt($('#telephone_destinateur').val())){
                            //             oui = false;
                            //         }
                            //     });
                            //     if(!oui){
                            //         good = false;
                            //         message+="Veuillez Changer Le Numéro De Téléphone De L'expéditeur Car Déja Existant !\n";    
                            //     }            
                            // }
                        }
                    }else{
                        good = false;
                        message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";        
                    }
            }else{
                good = false;
                message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";
            }
            }
        }else{
            if(!$('select[name="emetteur_id"]').val()){
                good = false;
                message+="Veuillez Selectionner Un Expéditeur !\n";    
            }else{
                if(parseInt($('select[name="emetteur_id"]').val()) == parseInt($('select[name="recepteur_id"]').val())){
                    good = false;
                    message+="Votre Expéditeur Doit Etre Différent De Votre Récepteur !\n";    
                }
            }
        }
    
        if($('#destinataire').val().trim()){
            if(!$('#telephone_destinataire').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone Du Récepteur Du Courrier !\n";  
            }else{
                if(reg.test($('#telephone_destinataire').val())){
                if($('#telephone_destinataire').val().length == 9){
                    if(parseInt($('#telephone_destinataire').val().slice(0, 1)) != 6){
                        good = false;
                        message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";            
                    }else{
                        let second = parseInt($('#telephone_destinataire').val().slice(1, 2));
                        if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                            good = false;
                            message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";
                        }
                        // else{
                        //     let yes = true;
                        //     personnes.forEach(personne => {
                        //         if(parseInt(personne.telephone) == parseInt($('#telephone_destinataire').val())){
                        //             yes = false;
                        //         }
                        //     });
                        //     if(!yes){
                        //         good = false;
                        //         message+="Veuillez Changer Le Numéro De Téléphone Du Récepteur Car Déja Existant !\n";
                        //     }            
                        // }
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";        
                }
            }else{
                good = false;
                message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";
            }
            }
        }else{
            if(!$('select[name="recepteur_id"]').val().trim()){
                good = false;
                message+="Veuillez Selectionner Un Récepteur !\n";    
            }
        }

        if(!$('#site_expediteur').val()){
            good = false;
            message+="Veuillez Selectionner Le Site Expéditeur Du Courrier !\n";
        }   

        if(!$('#site_recept_id').val()){
            good = false;
            message+="Veuillez Selectionner Le Site Récepteur Du Courrier !\n";
        }else{
            if(parseInt($('#site_expediteur').val()) == parseInt($('#site_recept_id').val())){
                good = false;
                message+="Votre Site Expéditeur Doit Etre Different De Votre Site Récepteur !\n";
            }
        }

        if(!$('#objet').val().trim()){
            good = false;
            message+="Veuillez Renseigner L'objet Du Courrier !\n";
        }   

        if(!$('#road').val()){
            good = false;
            message+="Veuillez Selectionner Un Itinéraire !\n";
        }   

        if(!good){
            good = false;
            $('#validation').val(message);
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');
        }else{
            $('#type_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="type_conf">${$('#TypeCourrier').val()}</span>`);
            $('#envoie_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="envoie_conf">${$("#TypeEnvoie").val()}</span>`);
            $('#dest_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="dest_conf">${$('#fullname_destinateur').val() ? $('#fullname_destinateur').val() : $("#selDestinateur option:selected").text() != "Selectionner Un Destinateur" ? $("#selDestinateur option:selected").text() : ''}</span>`);
            $('#tel_dest_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_dest_conf">${$("#phone_desti").val()}</span>`);
            $('#exp_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="exp_conf">${$("#destinateur").val() ? $("#destinateur").val() : $("#selPersonne option:selected").text()}</span>`);
            $('#tel_exp_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_exp_conf">${$("#telephone_destinateur").val()}</span>`);
            $('#recept_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="recept_conf">${$("#destinataire").val() ? $("#destinataire").val() : $("#selUser option:selected").text()}</span>`);
            $('#tel_recept_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_recept_conf">${$("#telephone_destinataire").val()}</span>`);
            $('#object_courrier_conf').val($("#objet").val());
            if($("#site_expediteur option:selected").text() != "Selectionner Un Site"){
                $('#site_exp_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="site_exp_conf">${$("#site_expediteur option:selected").text()}</span>`);
            }
            if($("#site_recept_id option:selected").text() != "Selectionner Un Site"){
                $('#site_recept_conf').replaceWith(`<span style="color: black; font-size: 15px;" id="site_recept_conf">${$("#site_recept_id option:selected").text()}</span>`);
            }
            $('#itineraire_ka').replaceWith(`<span style="color: black; font-size: 15px;" id="itineraire_ka">${$("#road").val() ? $("#road option:selected").text() : ''}</span>`);
            
            $('#modalconfirm_courrier').attr('data-backdrop', 'static');
            $('#modalconfirm_courrier').attr('data-keyboard', false);
            $('#modalconfirm_courrier').modal('show');
        }    
    });
});

$(document).on('click', '#conf_save_courrier', function(){
    $.ajax({
        type: 'POST',
        url: "createCourrier",
        data: $('#InsertFormCourrier').serialize(),
        headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success: function(data){

            $('#selDestinateur')
            .find('option')
            .remove()
            .end()
            .append(
                data[1].forEach(personne => {
                    $('#selDestinateur').append(`
                            <option value="${personne.id}">${personne.fullname} - ${personne.telephone}</option>
                    `)
                })
            );

            $('#selPersonne')
            .find('option')
            .remove()
            .end()
            .append(
                data[1].forEach(personne => {
                    $('#selPersonne').append(`
                            <option value="${personne.id}">${personne.fullname} - ${personne.telephone}</option>
                    `)
                })
            );

            $('#selUser')
            .find('option')
            .remove()
            .end()
            .append(
                data[1].forEach(personne => {
                    $('#selUser').append(`
                    <option value="${personne.id}">${personne.fullname} - ${personne.telephone}</option>
                    `)
                })
            );

            $(this).attr('data-personnes', JSON.stringify(data[1]));

            $('#InsertFormCourrier')[0].reset();
            $('#destinateur').attr('disabled', false);
            $('#telephone_destinateur').attr('disabled', false);
            $('select[name="emetteur_id"]').attr('disabled', false);
            $('#destinataire').attr('disabled', false);
            $('#telephone_destinataire').attr('disabled', false);
            $('select[name="recepteur_id"]').attr('disabled', false);
            $('#fullname_destinateur').attr('disabled', false);
            $('#phone_desti').attr('disabled', false);    
            $('select[name="destinateur_courrier"]').attr('disabled', false);
            $('select[name="destinateur_courrier"]').append(`<option selected value="">Selectionner Un Destinateur</option>`);
            $('select[name="emetteur_id"]').append(`<option selected value="">Selectionner Un Expéditeur</option>`);
            $('select[name="recepteur_id"]').append(`<option selected value="">Selectionner Un Récepteur</option>`);
        
            let courrier = data[0];

            if(courrier){
                $('#dataTable').prepend(`
                <tr style="font-size:20px; color:black;">
                    <td><label style="font-size:1.1em;"> ${courrier.code} </label></td>
                    <td><label>${courrier.emetteurs.fullname}</label></td>
                    <td><label> ${courrier.recepteurs.fullname} </label></td>
                    <td><label> ${courrier.status} </label></td>
                    <td><label> ${courrier.date_create} </label></td>
                    <td>
                        <div class='row'>

                            <?php @can('editer-courrier') ?>
                            <button class="btn btn-sm btn-info mr-2 ml-3"
                                    id="btnEdit" 
                                    name="btnEditCourrierViews"
                                    data-courrier=${courrier}
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-backdrop="static" 
                                    data-keyboard="false"
                                    ${courrier.status == "ENCOURS" ? '' : 'disabled'}>
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-envelope"></i>
                                        <i class="fas fa-pen" style="font-size:13px;"></i>
                                    </span>
                                </button>
                            <?php @endcan ?>

                            <?php @can('supprimer-courrier') ?>
                            <button class="btn btn-sm btn-danger mr-2" 
                                    name="btnCancelCourrier"
                                    title="Annuler" 
                                    id="btnAnnulerCourrier" 
                                    data-id=${courrier.id}
                                    ${courrier.status == "ENCOURS" ? '' : 'disabled'}>
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-envelope"></i>
                                        <i class="fas fa-times" style="font-size:13px;"></i>
                                    </span>
                            </button>
                            <?php @endcan ?>

                            <?php @can('voir-courrier') ?>
                            <button class="btn btn-sm btn-primary mr-2"
                                    name="btnViewCours"
                                    data-toggle="modal" 
                                    data-target="#viewCourrier"
                                    data-backdrop="static"
                                    data-keyboard="false"
                                    title="Voir">
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-envelope"></i>
                                        <i class="fas fa-eye" style="font-size:13px;"></i>
                                    </span>
                            </button>

                            <?php @endcan ?>

                            <?php @can('retirer-courrier') ?>
                            <button class="btn btn-dark" 
                                    title="Retrait" 
                                    id="btnRetrait" 
                                    data-id=${courrier.id} 
                                    data-toggle="modal" 
                                    data-target="#modalRetraitCourrier" 
                                    data-backdrop="static" 
                                    data-keyboard="false"
                                    ${courrier.status == "ENCOURS" ? '' : 'disabled'}>
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-envelope"></i>
                                        <i class="fas fa-upload" style="font-size:13px;"></i>
                                    </span>
                            </button>
                            <?php @endcan ?>
                            <button title="PDF COURRIER" 
                                    id="preview_button" 
                                    onclick="window.location='{{ route('preview', ['courrier' => json_encode(${courrier})]) }}'" 
                                    class="btn btn-sm" 
                                    style="background-color:#E63673; color:white;">
                                    <span class="icon text-white-80 m-1">
                                        <i class="fas fa-lg fa-envelope"></i>
                                        <i class="fas fa-file-pdf" style="font-size:13px;"></i>
                                    </span>
                            </button>
                        </div>
                    </td>
                </tr>
                `)
                $('#InsertFormCourrier')[0].reset();
                $('#modalconfirm_courrier').modal('toggle');
                }
            }                
         });
});


$(document).on('click', '#btnewcolis', function(){
    $('#InsertFormCourrier')[0].reset();
    $('#destinateur').attr('disabled', false);
    $('#telephone_destinateur').attr('disabled', false);
    $('#fullname_destinateur').attr('disabled', false);
    $('#phone_desti').attr('disabled', false);
    $('select[name="emetteur_id"]').attr('disabled', false);
    $('select[name="destinateur_courrier"]').attr('disabled', false);
    $('#destinataire').attr('disabled', false);
    $('#telephone_destinataire').attr('disabled', false);
    $('select[name="recepteur_id"]').attr('disabled', false);
    $('select[name="destinateur_courrier"]').append(`<option selected value="">Selectionner Un Destinateur</option>`);
    $('select[name="emetteur_id"]').append(`<option selected value="">Selectionner Un Expéditeur</option>`);
    $('select[name="recepteur_id"]').append(`<option selected value="">Selectionner Un Récepteur</option>`);
});

$('button[name="btnEditCourrierViews"]').on('click', function(){
    
    let courrier = JSON.parse($(this).attr('data-courrier'));
    let personnes = JSON.parse($(this).attr('data-personnes'));

    if(courrier.destinateur_id){
        $('#fullname_destinateur_edit').attr('disabled', true);
        $('#phone_desti_edit').attr('disabled', true);
    }
    $('#destinateurEdit').attr('disabled', true);
    $('#telephone_destinateurEdit').attr('disabled', true);
    $('#destinataireEdit').attr('disabled', true);
    $('#telephone_destinataireEdit').attr('disabled', true);

    
    $('#id_edit_courrier').val(courrier.id);
    $('#numero_edit_courrier').replaceWith(`
        <span class="badge badge-success" id="numero_edit_courrier">${courrier.code}</span>`)
    $('#TypeCourrierEdit').val(courrier.TypeCourrier);
    $('#TypeEnvoieEdit').val(courrier.TypeEnvoie);
    if(courrier.TypeEnvoie == "INTERNE"){
        let sites = JSON.parse($(this).attr('data-sites'));
        let site_interne = [];
        for (let index = 0; index < sites.length; index++) {
            const site = sites[index];
            if(site.categorieSite == "AGENCE" || site.categorieSite == "SERVICE"){
                site_interne.push(site);
            }
        }

        $('#site_recept_idEdit').find('option').remove().end();
        $('#site_recept_idEdit').append(`<option value="">Selectionner Un Site</option>`);
        for (let index = 0; index < site_interne.length; index++) {
            const site = site_interne[index];
            $('#site_recept_idEdit').append(`<option value="${site.id}">${site.intituleSite}</option>`);
        }

    }
    if(courrier.destinateurs){
        $('select[name="destinateur_courrier_edit"]').append(`
            <option value="${courrier.destinateur_id}" selected>${courrier.destinateurs.fullname} - ${courrier.destinateurs.telephone}</option>
        `);
    }
    $('select[name="emetteur_id"]').append(`
       <option value="${courrier.emetteur_id}" selected>${courrier.emetteurs.fullname} - ${courrier.emetteurs.telephone}</option>
    `);
    $('select[name="recepteur_id"]').append(`
    <option value="${courrier.recepteur_id}" selected>${courrier.recepteurs.fullname} - ${courrier.recepteurs.telephone}</option>
    `);
    $('#site_recept_idEdit').val(courrier.site_recept_id);
    $('#site_expediteur_edit').val(courrier.site_exp_id);
    $('#TransitoireEdit').val(courrier.Transitoire);
    $('#objetEdit').val(courrier.objet);
    $('#road_edit').val(courrier.itineraire);

    if(courrier.chauffeur_id){
        $('#chauffeur_id').find('option').remove().end();
        $('#chauffeur_id').append(`<option value="">Selectionner Un Conducteur</option>`);
        personnes.forEach(personne => {
            $('#chauffeur_id').append(`<option value="${personne.id}">${personne.fullname}</option>`)
        })

        $('#chauffeur_id').val(courrier.chauffeur_id);
        if(courrier.chauffeurs.vehicule_effectif_id){
            $('#vehicule_effectif_id').val(courrier.chauffeurs.vehicule_effectif_id);
        }else if(courrier.chauffeurs.vehicule_id){
            $('#vehicule_effectif_id').val(courrier.chauffeurs.vehicule_id);
        }
    }
});

$(document).ready(function(){
    $('#btnEditCourrier').on('click', function(){

        let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

        let good = true;
        let message = "";

        let tab = $(this).attr('data-personnes');
    
        let personnes = JSON.parse(tab);    
    
        if(!$('#TypeCourrierEdit').val().trim()){
            good = false;
            message+="Veuillez Selectionner Un Type De Courrier !\n";
        }
        if(!$('#TypeEnvoieEdit').val().trim()){
            good = false;
            message+="Veuillez Selectionner Un Type D'envoit !\n";
        }


        if($('#fullname_destinateur_edit').val().trim()){
            if(!$('#phone_desti_edit').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone Du Destinateur Du Courrier !\n";  
            }else{
                if(reg.test($('#phone_desti_edit').val())){
                if($('#phone_desti_edit').val().length == 9){
                    if(parseInt($('#phone_desti_edit').val().slice(0, 1)) != 6){
                        good = false;
                        message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";            
                    }else{
                        let second = parseInt($('#phone_desti_edit').val().slice(1, 2));
                        if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                            good = false;
                            message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";
                        }else{
                            let oui = true;
                            personnes.forEach(personne => {
                                if(parseInt(personne.telephone) == parseInt($('#phone_desti_edit').val())){
                                    oui = false;
                                }
                            });
                            if(!oui){
                                good = false;
                                message+="Veuillez Changer Le Numéro De Téléphone Du Destinateur Car Déja Existant !\n";    
                            }            
                        }
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";        
                }
              }else{
                good = false;
                message+="Format Du Numéro De Téléphone Du Destinateur Incorrect !\n";        
              }
            }
        }else{
            if($('#phone_desti_edit').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Destinateur Du Courrier !\n";    
            }
        }
    

        if($('#destinateurEdit').val().trim()){
            if(!$('#telephone_destinateurEdit').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone De L'expéditeur Du Courrier !\n";    
            }else{
                if(reg.test($('#telephone_destinateurEdit').val())){
                if($('#telephone_destinateurEdit').val().length == 9){
                    if(parseInt($('#telephone_destinateurEdit').val().slice(0, 1)) != 6){
                        good = false;
                        message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";            
                    }else{
                        let second = parseInt($('#telephone_destinateurEdit').val().slice(1, 2));
                        if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                            good = false;
                            message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";
                        }else{
                            let oui = true;
    
                            personnes.forEach(personne => {
                                if(parseInt(personne.telephone) == parseInt($('#telephone_destinateurEdit').val())){
                                    oui = false;
                                }
                            });
                            if(!oui){
                                good = false;
                                message+="Veuillez Changer Le Numéro De Téléphone De L'expéditeur Car Déja Existant !\n";    
                            }            
                        }
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";        
                }
              }else{
                good = false;
                message+="Format Du Numéro De Téléphone De L'expéditeur Incorrect !\n";        
            }    
            }
        }else{
            if(!$('#selPersonneEdit').val()){
                good = false;
                message+="Veuillez Selectionner Un Expéditeur !\n";    
            }else{
                if(parseInt($('#selPersonneEdit').val()) == parseInt($('#selUserEdit').val())){
                    good = false;
                    message+="Votre Expéditeur Doit Etre Différent De Votre Récepteur !\n";    
                }
            }
        }
        
        if($('#destinataireEdit').val().trim()){
            if(!$('#telephone_destinataireEdit').val().trim()){
                good = false;
                message+="Veuillez Renseigner Un Numéro De Téléphone Du Récepteur Du Courrier !\n";  
            }else{
                if(reg.test($('#telephone_destinataireEdit').val())){
                if($('#telephone_destinataireEdit').val().length == 9){
                    if(parseInt($('#telephone_destinataireEdit').val().slice(0, 1)) != 6){
                        good = false;
                        message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";            
                    }else{
                        let second = parseInt($('#telephone_destinataireEdit').val().slice(1, 2));
                        if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                            good = false;
                            message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";
                        }else{
                            let yes = true;
                            personnes.forEach(personne => {
                                if(parseInt(personne.telephone) == parseInt($('#telephone_destinataireEdit').val())){
                                    yes = false;
                                }
                            });
                            if(!yes){
                                good = false;
                                message+="Veuillez Changer Le Numéro De Téléphone Du Récepteur Car Déja Existant !\n";
                            }
                        }
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";        
                }
              }else{
                good = false;
                message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";        
            }    
            }
        }else{
            if(!$('#selUserEdit').val().trim()){
                good = false;
                message+="Veuillez Selectionner Un Récepteur !\n"; 
            }
        }
    
    
        if(!$('#objetEdit').val().trim()){
            good = false;
            message+="Veuillez Renseigner L'objet Du Courrier !\n";
        } 
        
        if(!$('#chauffeur_id').val()){
            if($('#vehicule_effectif_id').val()){
                good = false;
                message+="Veuillez Selectionner Un Chauffeur !\n";
            }
        }

        if(!good){
            good = false;
            $('#validation').val(message);
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');
        }else{
            $('#type_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="type_conf_edit">${$('#TypeCourrierEdit').val()}</span>`);
            $('#envoie_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="envoie_conf_edit">${$("#TypeEnvoieEdit").val()}</span>`);
            $('#dest_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="dest_conf_edit">${$('#fullname_destinateur_edit').val() ? $('#fullname_destinateur_edit').val() : $("#selDestin_cour option:selected").text() != "Selectionner Un Destinateur" ? $("#selDestin_cour option:selected").text() : ''}</span>`);
            $('#tel_dest_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_dest_conf_edit">${$("#phone_desti_edit").val()}</span>`);
            $('#exp_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="exp_conf_edit">${$("#destinateurEdit").val() ? $("#destinateurEdit").val() : $("#selPersonneEdit option:selected").text()}</span>`);
            $('#tel_exp_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_exp_conf_edit">${$("#telephone_destinateurEdit").val()}</span>`);
            $('#recept_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="recept_conf_edit">${$("#destinataireEdit").val() ? $("#destinataireEdit").val() : $("#selUserEdit option:selected").text()}</span>`);
            $('#tel_recept_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="tel_recept_conf_edit">${$("#telephone_destinataireEdit").val()}</span>`);
            $('#object_courrier_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="object_courrier_conf_edit">${$("#objetEdit").val()}</span>`);
            if($("#site_expediteur_edit option:selected").text() != "Selectionner Un Site"){
                $('#site_exp_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="site_exp_conf_edit">${$("#site_expediteur_edit option:selected").text()}</span>`);
            }
            if($("#site_recept_idEdit option:selected").text() != "Selectionner Un Site"){
                $('#site_recept_conf_edit').replaceWith(`<span style="color: black; font-size: 15px;" id="site_recept_conf_edit">${$("#site_recept_idEdit option:selected").text()}</span>`);
            }
            $('#chauffeur_courrier').replaceWith(`<span style="color: black; font-size: 15px;" id="chauffeur_courrier">${$('#chauffeur_id').val() ? $('#chauffeur_id option:selected').text() : ''}</span>`);
            $('#chauffeur_vehicule').replaceWith(`<span style="color: black; font-size: 15px;" id="chauffeur_vehicule">${$('#vehicule_effectif_id').val() ? $('#vehicule_effectif_id option:selected').text() : ''}</span>`);
            $('#itineraire_c').replaceWith(`<span style="color: black; font-size: 15px;" id="itineraire_c">${$('#road_edit').val() ? $('#road_edit option:selected').text() : ''}</span>`);
            $('#modalconfirm_edit_courrier').attr('data-backdrop', 'static');
            $('#modalconfirm_edit_courrier').attr('data-keyboard', false);
            $('#modalconfirm_edit_courrier').modal('show');
        }  
        
    });
})

$(document).on('click', '#conf_edit_courrier', function(){
    $.ajax({
        type:'PUT',
        url: 'editCourrier',
        data: $('#EditFormCourrier').serialize(),
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            location.reload();
        }
    })
});


$(document).on('click', "#btnRetrait", function(){
    let courrier = JSON.parse($(this).attr('data-courrier'));
    $('#id_retrait').val(courrier.id);
    $('#numero_courrier').replaceWith(`<span class="badge badge-success" id="numero_courrier">${courrier.code}</span>`)
});


$('#btnRetraitCourrier').on('click', function(){

        let good = true;
        let message = "";

        let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

        if(!$('select[name="coursier_id"]').val() &&
           !($('#fullname_retrait').val().trim() && $('#telephone_retrait').val()) &&
           !($('#cni').val().trim() && $('#date_validite_cni').val())){
                good = false;
                message += "Veuillez Renseigner Un Enléveur ! \n";
        }

        if($('#cni').val()){
            if(!$('#date_validite_cni').val()){
                good = false;
                message+="Veuillez Renseigner La Date De Validité De La CNI !\n";
            }
        }else{
            if($('#date_validite_cni').val()){
                good = false;
                message+="Veuillez Renseigner Le Numéro De La CNI !\n";
            }
        }
        
        if(($('#fullname_retrait').val().trim())){
            if(!$('#telephone_retrait').val().trim()){
                good = false;
                message+="Veuillez Renseigner Le Numéro De Téléphone De L'Enléveur !\n";
            }else{
                if(reg.test($('#telephone_retrait').val())){
                    if($('#telephone_retrait').val().length == 9){
                        if(parseInt($('#telephone_retrait').val().slice(0, 1)) != 6){
                            good = false;
                            message+="Format Du Numéro De Téléphone Incorrect !\n";            
                        }else{
                            let second = parseInt($('#telephone_retrait').val().slice(1, 2));
                            if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                                good = false;
                                message+="Format Du Numéro De Téléphone Incorrect !\n";
                            }
                        }
                    }else{
                        good = false;
                        message+="Format Du Numéro De Téléphone Incorrect !\n";        
                    }
                }else{
                    good = false;
                    message+="Format Du Numéro De Téléphone De L'Enléveur Incorrect !\n";
                }
            }
        }else{
            if($('#telephone_retrait').val().trim()){
                good = false;
                message+="Veuillez Renseigner Le Nom De L'Enléveur  !\n";
            }
        }
        if(!good){
            good = false;
            $('#validation').val(message);
            $('#errorvalidationsModals').attr('data-backdrop', 'static');
            $('#errorvalidationsModals').attr('data-keyboard', false);
            $('#errorvalidationsModals').modal('show');
        }else{

        $.ajax({
            type: 'PUT',
            url: 'retraitCourrier',
            data: $('#RetraitCourrierForm').serialize(),
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(){
                location.reload();
            }
        })
        }
})

$(document).on('click', '#btnReception', function(){
    let courrier = JSON.parse($(this).attr('data-courrier'));
    $('#id_reception').val(courrier.id);
    $('#numero_courrier').replaceWith(`<span class="badge badge-success" id="numero_courrier">${courrier.code}</span>`)
});

$('#btnReceptionCourrier').on('click', function(){

    $('#status_reception').val("RECEPTIONNER");

        $.ajax({
            type:'POST',
            url: 'receptionCourrier',
            data: $('#ReceptionCourrierForm').serialize(),
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(){
                location.reload();
            }
        });
})

$(document).on('click', '#btnLivraison', function(){
    let courrier = JSON.parse($(this).attr('data-courrier'));
    $('#id_livraison').val(courrier.id);
    $('#numero_courrier').replaceWith(`<span class="badge badge-success" id="numero_courrier">${courrier.code}</span>`)
});


$('#btnLivraisonCourrier').on('click', function(){

    $('#status_livraison').val("LIVRER");  

    let good = true;
    let message = "";

    let reg =  /^[^a-z\^A-Z\^`~!@#$%^&*()_+={}\[\]|\\:;“’<,>.?๐฿]+$/;

    if(!$('select[name="recepteur_effectif_id"]').val().trim()){

            if(!$('#fullname_livraison').val().trim()){
                if($('#telephone_livraison').val().trim()){
                    good = false;
                    message+="Veuillez Renseigner Un Nom !\n";
                }
            }else{
                if(!$('#telephone_livraison').val().trim()){
                    good = false;
                    message+="Veuillez Renseigner Un Numéro De Téléphone !\n";
                }else{
                    if(reg.test($('#telephone_livraison').val())){
                        if($('#telephone_livraison').val().length == 9){
                            if(parseInt($('#telephone_livraison').val().slice(0, 1)) != 6){
                                good = false;
                                message+="Format Du Numéro De Téléphone Incorrect !\n";            
                            }else{
                                let second = parseInt($('#telephone_livraison').val().slice(1, 2));
                                if(second != 5 && second != 6 && second != 7 && second != 8 && second != 9){
                                    good = false;
                                    message+="Format Du Numéro De Téléphone Incorrect !\n";
                                }else{
                                    let personnes = JSON.parse($(this).attr('data-personnes'));
                                    let yes = true;
                
                                    personnes.forEach(personne => {
                                        if(parseInt(personne.telephone) == parseInt($('#telephone_livraison').val())){
                                            yes = false;
                                        }
                                    });
                                    if(!yes){
                                        good = false;
                                        message+="Veuillez Renseigner Un Autre Numéro De Téléphone Car Déja Existant !\n";
                                    }
                
                                }
                            }
                        }else{
                            good = false;
                            message+="Format Du Numéro De Téléphone Incorrect !\n";        
                        }
                    }else{
                        good = false;
                        message+="Format Du Numéro De Téléphone Du Récepteur Incorrect !\n";        
                    }
                }
            }
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
            url: 'livraisonCourrier',
            data: $('#LivraisonCourrierForm').serialize(),
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(){
                location.reload();
            }
        })
    }

})


$(document).ready(function(){
    $('button[name="btnViewCours"]').on('click', function(){
    let courrier = JSON.parse($(this).attr('data-courrier'));
    let vehicules = JSON.parse($(this).attr('data-cars'));

    $('#number_courrier').replaceWith(`<span class="badge badge-success" id="number_courrier">${courrier.code}</span>`)

    $('#numeroCourrier').val(courrier.code);
    $('#typecourrier').val(courrier.TypeCourrier);
    $('#typenvoi').val(courrier.TypeEnvoie);
    $('#object').val(courrier.objet);
    $('#destinat_courrier').val(courrier.destinateurs ? courrier.destinateurs.fullname : '');
    $('#destinat_telephone').val(courrier.destinateurs ? courrier.destinateurs.telephone : '');
    $('#coursier_courrier_name').val(courrier.coursiers ? courrier.coursiers.fullname : '');
    $('#coursier_courrier_telephone').val(courrier.coursiers ? courrier.coursiers.telephone : '');
    $('#chaufeur').val(courrier.chauffeurs ? courrier.chauffeurs.fullname : '');
    $('#chauffeur_telephone').val(courrier.chauffeurs ? courrier.chauffeurs.telephone : '');
    if(courrier.chauffeurs){
        if(courrier.chauffeurs.vehicule_effectif_id){
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_effectif_id))).Immatriculation);
        }else{
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_id))).Immatriculation);
        }
    }
    $('#emetteur').val(courrier.emetteurs.fullname);
    $('#emetteur_telephone').val(courrier.emetteurs.telephone);
    $('#recepteur').val(courrier.recepteurs.fullname);
    $('#recepteur_telephone').val(courrier.recepteurs.telephone);
    $('#site_recept').val(courrier.site_recepts ? courrier.site_recepts.intituleSite : '');
    $('#site_exp').val(courrier.site_exps ? courrier.site_exps.intituleSite : '');
    $('#statut_cour').val(courrier.status);
    $('#transitoir').val(courrier.Transitoire ? courrier.Transitoire : '');
    $('#date_create').val(courrier.date_create);
    $('#date_retrait_index').val(courrier.DateRetraitCourrier ? courrier.DateRetraitCourrier : '');
    $('#date_rec_courrier').val(courrier.DateReceptCourrier ? courrier.DateReceptCourrier : '');
    $('#date_liv').val(courrier.DateLivraionCourrier ? courrier.DateLivraionCourrier : '');
    $('#itin_colis').val(courrier.itineraires ? courrier.itineraires.lieux_depart +'-'+ courrier.itineraires.lieux_arrivee +'-'+ courrier.itineraires.duree + 'H' : '');
    });
})



$(document).ready(function(){
    $('button[name="btnViewLiv"]').on('click', function() {
    let courrier = JSON.parse($(this).attr('data-courrier'));
    let vehicules = JSON.parse($(this).attr('data-cars'));

    $('#number_courrier').replaceWith(`<span class="badge badge-success" id="number_courrier">${courrier.code}</span>`)

    $('#numeroCourrier').val(courrier.code);
    $('#typecourrier').val(courrier.TypeCourrier);
    $('#typenvoi').val(courrier.TypeEnvoie);
    $('#object').val(courrier.objet);
    $('#destinat_courrier').val(courrier.destinateurs ? courrier.destinateurs.fullname : '');
    $('#destinat_telephone').val(courrier.destinateurs ? courrier.destinateurs.telephone : '');
    $('#chauffeur').val(courrier.chauffeurs ? courrier.chauffeurs.fullname : '');
    $('#chauffeur_telephone').val(courrier.chauffeurs ? courrier.chauffeurs.telephone : '');
    if(courrier.chauffeurs){
        if(courrier.chauffeurs.vehicule_effectif_id){
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_effectif_id))).Immatriculation);
        }else{
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_id))).Immatriculation);
        }
    }
    $('#emetteur').val(courrier.emetteurs.fullname);
    $('#emetteur_telephone').val(courrier.emetteurs.telephone);
    $('#recepteur').val(courrier.recepteurs.fullname);
    $('#recepteur_telephone').val(courrier.recepteurs.telephone);
    $('#site_exp').val(courrier.site_exps ? courrier.site_exps.intituleSite : '');
    $('#site_recept').val(courrier.site_recepts ? courrier.site_recepts.intituleSite : '');
    $('#statut_cour').val(courrier.status);
    $('#transitoir').val(courrier.Transitoire);
    $('#date_create').val(courrier.date_create);
    $('#date_retrait').val(courrier.DateRetraitCourrier);
    $('#date_recept').val(courrier.DateReceptCourrier);
    $('#date_liv').val(courrier.DateLivraionCourrier);
    $('#coursier_courrier').val(courrier.coursiers ? courrier.coursiers.fullname : '');
    $('#coursier_courrier_phone').val(courrier.coursiers ? courrier.coursiers.telephone : '');
    $('#recepteur_eff').val(courrier.recepteur_effectifs ? courrier.recepteur_effectifs.fullname : '');
    $('#recepteur_eff_phone').val(courrier.recepteur_effectifs ? courrier.recepteur_effectifs.telephone : '');
    $('#itin_colis').val(courrier.itineraires ? courrier.itineraires.lieux_depart +'-'+ courrier.itineraires.lieux_arrivee +'-'+ courrier.itineraires.duree + 'H' : '');
    })
});


$(document).ready(function(){
    $('button[name="btnViewReception"]').on('click', function(){
        let courrier = JSON.parse($(this).attr('data-courrier'));
        let vehicules = JSON.parse($(this).attr('data-cars'));
        $('#number_courrier').replaceWith(`<span class="badge badge-success" id="number_courrier">${courrier.code}</span>`)
        
        $('#numeroCourrier').val(courrier.code);
        $('#typecourrier').val(courrier.TypeCourrier);
        $('#typenvoi').val(courrier.TypeEnvoie);
        $('#object').val(courrier.objet);
        $('#destinat_courrier').val(courrier.destinateurs ? courrier.destinateurs.fullname : '');
        $('#destinat_telephone').val(courrier.destinateurs ? courrier.destinateurs.telephone : '');
        $('#chauffeur').val(courrier.chauffeurs ? courrier.chauffeurs.fullname : '');
        $('#chauffeur_telephone').val(courrier.chauffeurs ? courrier.chauffeurs.telephone : ''); 
        if(courrier.chauffeurs){
            if(courrier.chauffeurs.vehicule_effectif_id){
                $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_effectif_id))).Immatriculation);
            }else{
                $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_id))).Immatriculation);
            }
        }
        $('#emetteur').val(courrier.emetteurs.fullname);
        $('#emetteur_telephone').val(courrier.emetteurs.telephone);
        $('#recepteur').val(courrier.recepteurs.fullname);
        $('#recepteur_telephone').val(courrier.recepteurs.telephone);
        $('#site_exp').val(courrier.site_exps ? courrier.site_exps.intituleSite : '');
        $('#site_recept').val(courrier.site_recepts ? courrier.site_recepts.intituleSite : '');
        $('#statut_cour').val(courrier.status);
        $('#transitoir').val(courrier.Transitoire);
        $('#date_create').val(courrier.date_create);
        $('#date_retrait_courrier').val(courrier.DateRetraitCourrier);
        $('#coursier_courrier_name').val(courrier.coursiers ? courrier.coursiers.fullname : '');
        $('#coursier_courrier_telephone').val(courrier.coursiers ? courrier.coursiers.telephone : '');
        $('#itin_colis').val(courrier.itineraires ? courrier.itineraires.lieux_depart +'-'+ courrier.itineraires.lieux_arrivee +'-'+ courrier.itineraires.duree + 'H' : '');
    })
})

$(document).ready(function(){
    $('button[name="btnColisViews"]').on('click', function(){
        let courrier = JSON.parse($(this).attr('data-courrier'));
        let vehicules = JSON.parse($(this).attr('data-cars'));

        $('#number_courrier').replaceWith(`<span class="badge badge-success" id="number_courrier">${courrier.code}</span>`)

        $('#numeroCourrier').val(courrier.code);
        $('#typecourrier').val(courrier.TypeCourrier);
        $('#typenvoi').val(courrier.TypeEnvoie);
        $('#object').val(courrier.objet);
        $('#destinat_courrier').val(courrier.destinateurs ? courrier.destinateurs.fullname : '');
        $('#destinat_telephone').val(courrier.destinateurs ? courrier.destinateurs.telephone : '');
        $('#chauffeurs').val(courrier.chauffeurs ? courrier.chauffeurs.fullname : '');
        $('#chauffeurs_telephone').val(courrier.chauffeurs ? courrier.chauffeurs.telephone : '');  
        if(courrier.chauffeurs){
            if(courrier.chauffeurs.vehicule_effectif_id){
                $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_effectif_id))).Immatriculation);
            }else{
                $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_id))).Immatriculation);
            }
        }
        $('#emetteur').val(courrier.emetteurs.fullname);
        $('#emetteur_telephone').val(courrier.emetteurs.telephone);
        $('#recepteur').val(courrier.recepteurs.fullname);
        $('#recepteur_telephone').val(courrier.recepteurs.telephone);
        $('#site_exp').val(courrier.site_exps ? courrier.site_exps.intituleSite : '');
        $('#site_recept').val(courrier.site_recepts ? courrier.site_recepts.intituleSite : '');
        $('#statut_cour').val(courrier.status);
        $('#transitoir').val(courrier.Transitoire);
        $('#date_create').val(courrier.date_create);
        $('#date_retrait_courrier').val(courrier.DateRetraitCourrier);
        $('#date_rec_courrier').val(courrier.DateReceptCourrier);
        $('#coursier_courrier_name').val(courrier.coursiers ? courrier.coursiers.fullname : '');
        $('#coursier_courrier_telephone').val(courrier.coursiers ? courrier.coursiers.telephone : '');
        $('#itin_colis').val(courrier.itineraires ? courrier.itineraires.lieux_depart +'-'+ courrier.itineraires.lieux_arrivee +'-'+ courrier.itineraires.duree + 'H' : '');
    });
})

$(document).ready(function(){
    $('button[name="btnCancelCourrier"]').on('click', function(){
        if(confirm("Voulez-vous Vraiment Annuler Ce Courrier "+ $(this).attr('data-code') +"  ?") == true){
            $.ajax({
                type: 'POST',
                url: 'annulerCourrier',
                data: {id: $(this).attr('data-id'), status: "ANNULER"},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(){
                    location.reload();
                }
            })
        }
    })    
})

$(document).on('change', '#posteIndexPage', function(){
    if($(this).val()){
        let personnes = JSON.parse($(this).attr('data-personnes'));
        $('#chauffeur_id').find('option').remove().end();
        $('#chauffeur_id').append(`<option value="">Selectionner Un Conducteur</option>`);
        
        personnes.forEach(personne => {
            if(personne.postes){
                if(personne.postes.intitulePoste == $('#posteIndexPage option:selected').text()){
                    $('#chauffeur_id').append(`<option value="${personne.id}">${personne.fullname}</option>`)
                }
            }
        })
    }

});

// Other Events


//Mes SelUser

$(document).ready(function(){
    // Initialize select2
    $("#selDestin_cour").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selDestin_cour option:selected').text();
      var userid = $('#selDestin_cour').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});

$(document).ready(function(){
    // Initialize select2
    $("#selDestinateur").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selDestinateur option:selected').text();
      var userid = $('#selDestinateur').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});


$(document).ready(function(){
    // Initialize select2
    $("#selUserEdit").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selUser option:selected').text();
      var userid = $('#selUser').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});


$(document).ready(function(){
    // Initialize select2
    $("#selUser").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selUser option:selected').text();
      var userid = $('#selUser').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});


$(document).ready(function(){
    // Initialize select2
    $("#selUserLivraison").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selUserLivraison option:selected').text();
      var userid = $('#selUserLivraison').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});

$(document).ready(function(){
    // Initialize select2
    $("#selPersonneEdit").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selPersonneEdit option:selected').text();
      var userid = $('#selPersonneEdit').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});


$(document).ready(function(){
    // Initialize select2
    $("#selPersonne").select2();
    // Read selected option
    $('#but_read').click(function(){
      var username = $('#selPersonne option:selected').text();
      var userid = $('#selPersonne').val();
  
      $('#result').html("id : " + userid + ", name : " + username);
  
    });
});
//End Mes SelUser

// index page
    
    //PDF par Date
    $(document).on('change', '#date_print', function(){
        if($(this).val()){
            $('#btn_pdf_date').attr('disabled', false);
        }else{
            $('#btn_pdf_date').attr('disabled', true);
        }
    });

    $(document).on('click', '#btnClose', function(){
        location.reload();
    });

    $('#btnResetForm').click(function() {
        $('#InsertFormCourrier')[0].reset();
        $('#destinateur').attr('disabled', false);
        $('#telephone_destinateur').attr('disabled', false);
        $('#fullname_destinateur').attr('disabled', false);
        $('#phone_desti').attr('disabled', false);
        $('select[name="emetteur_id"]').attr('disabled', false);
        $('select[name="destinateur_courrier"]').attr('disabled', false);
        $('#destinataire').attr('disabled', false);
        $('#telephone_destinataire').attr('disabled', false);
        $('select[name="recepteur_id"]').attr('disabled', false);
        $('select[name="destinateur_courrier"]').append(`<option selected value="">Selectionner Un Destinateur</option>`);
        $('select[name="emetteur_id"]').append(`<option selected value="">Selectionner Un Expéditeur</option>`);
        $('select[name="recepteur_id"]').append(`<option selected value="">Selectionner Un Récepteur</option>`);
    });

    $('#btnResetFormEdit, #btnCloseEdit').click(function() {
        $('#EditFormCourrier')[0].reset();
        $('#destinateurEdit').attr('disabled', false);
        $('#telephone_destinateurEdit').attr('disabled', false);
        $('select[name="emetteur_id"]').attr('disabled', false);
        $('#destinataireEdit').attr('disabled', false);
        $('#telephone_destinataireEdit').attr('disabled', false);
        $('select[name="recepteur_id"]').attr('disabled', false);
        $('#fullname_destinateur_edit').attr('disabled', false);
        $('#phone_desti_edit').attr('disabled', false);
        $('select[name="destinateur_courrier_edit"]').attr('disabled', false);
        $('select[name="destinateur_courrier_edit"]').append(`<option selected value="">Selectionner Un Destinateur</option>`);
        $('select[name="emetteur_id"]').append(`<option selected value="">Selectionner Un Expéditeur</option>`);
        $('select[name="recepteur_id"]').append(`<option selected value="">Selectionner Un Récepteur</option>`);
    });

    //INPUT TYPE ENVOIE FORMULAIRE ADD COURRIER
    $(document).on('change', '#TypeEnvoie', function(){
        if($(this).val()){
            let sites = JSON.parse($(this).attr('data-sites'));
            if($(this).val() == "INTERNE"){
                let site_interne = [];
                sites.forEach(site => {
                    if(site.categorieSite == "AGENCE" || site.categorieSite == "SERVICE"){
                        site_interne.push(site);
                    }
                });
                    $('select[name="site_recept_id"]').find('option').remove().end();
                    $('select[name="site_recept_id"]').append(`<option value="">Selectionner Un Site</option>`);
                    site_interne.forEach(site => {
                        $('select[name="site_recept_id"]').append(`<option value="${site.id}">${site.intituleSite}</option>`);
                    });
            }else{
                $('select[name="site_recept_id"]').find('option').remove().end();
                $('select[name="site_recept_id"]').append(`<option value="">Selectionner Un Site</option>`);
                sites.forEach(site => {
                    $('select[name="site_recept_id"]').append(`<option value="${site.id}">${site.intituleSite}</option>`);
                });
            }
        }
    });


        //INPUT TYPE ENVOIE FORMULAIRE EDIT COURRIER
        $(document).on('change', '#TypeEnvoieEdit', function(){
            
            if($(this).val()){
                let sites = JSON.parse($(this).attr('data-sites'));
                
                if($(this).val() == "INTERNE"){
                    let site_interne = [];
                    for (let index = 0; index < sites.length; index++) {
                        const site = sites[index];
                        if(site.categorieSite == "AGENCE" || site.categorieSite == "SERVICE"){
                            site_interne.push(site);
                        }
                    }

                    $('#site_recept_idEdit').find('option').remove().end();
                    $('#site_recept_idEdit').append(`<option value="">Selectionner Un Site</option>`);
                    for (let index = 0; index < site_interne.length; index++) {
                        const site = site_interne[index];
                        $('#site_recept_idEdit').append(`<option value="${site.id}">${site.intituleSite}</option>`);
                    }
                }else{
                    $('#site_recept_idEdit').find('option').remove().end();
                    $('#site_recept_idEdit').append(`<option value="">Selectionner Un Site</option>`);
                    sites.forEach(site => {
                        $('#site_recept_idEdit').append(`<option value="${site.id}">${site.intituleSite}</option>`);
                    });
                }
            }
        });

        
    //Input Fullname ET Telephone Retrait
    $(document).on("input", "#fullname_retrait, #telephone_retrait", function(){    
        if($('#fullname_retrait').val().trim() || $('#telephone_retrait').val()){
            $('#cni').prop('disabled', true);
            $('#date_validite_cni').prop('disabled', true);
            $('select[name="coursier_id"]').prop('disabled', true);
        }else{
            $('#cni').prop('disabled', false);
            $('#date_validite_cni').prop('disabled', false);
            $('select[name="coursier_id"]').prop('disabled', false);
        }
    });

    $('#btnClose_retrait, #btnExit_retrait').click(function(){
        $('#RetraitCourrierForm')[0].reset();
        $('select[name="coursier_id"]').append(`<option value="">Selectionner Un Coursier</option>`);
        $('#fullname_retrait, #telephone_retrait').prop('disabled', false);
        $('select[name="coursier_id"]').prop('disabled', false);
        $('#cni').prop('disabled', false);
        $('#date_validite_cni').prop('disabled', false);
    })

    $('#btnExit_reception').click(function(){
        $('#ReceptionCourrierForm')[0].reset();
    })

    $('#btnClose_index_livraison, #btnExit_livraison').click(function(){
        $('#LivraisonCourrierForm')[0].reset();
        $('select[name="recepteur_effectif_id"]').prop('disabled', false);
        $('#fullname_livraison').attr('disabled', false);
        $('#telephone_livraison').attr('disabled', false);
        $('select[name="recepteur_effectif_id"]').append(`<option selected value="">Selectionner Une Personne</option>`);

    })


//CNI DANS RETRAIT
$(document).on('input', '#cni, #date_validite_cni', function(){
    if($('#cni').val() || $('#date_validite_cni').val()){
        $('select[name="coursier_id"]').prop('disabled', true);
        $('#fullname_retrait, #telephone_retrait').prop('disabled', true);
    }else{
        $('select[name="coursier_id"]').prop('disabled', false);
        $('#fullname_retrait, #telephone_retrait').prop('disabled', false);
    }
});

//Select Option Poste Dans Retrait
$(document).ready(function(){
    $('select[name="coursier_id"]').on("input", function(){
        
        if($(this).val()){
        $('#fullname_retrait, #telephone_retrait').prop('disabled', true);
        $('#cni, #date_validite_cni').prop('disabled', true);
        }else{
            $('#fullname_retrait, #telephone_retrait').prop('disabled', false);
            $('#cni, #date_validite_cni').prop('disabled', false);
        }
    })
})

//Set Recepteur Effectif
$(document).ready(function(){
    $('select[name="recepteur_effectif_id"]').on("input", function(){
        if($('select[name="recepteur_effectif_id"]').val().trim()){
            $('#fullname_livraison').attr('disabled', true);
            $('#telephone_livraison').attr('disabled', true);        
        }else{
            $('#fullname_livraison').attr('disabled', false);
            $('#telephone_livraison').attr('disabled', false);   
        }
    })
})


//Input Destinateur Courrier Create
$(document).ready(function(){
    $('#fullname_destinateur, #phone_desti').on("input", function() {
    if($("#fullname_destinateur").val().trim() || $('#phone_desti').val().trim()){
        $('select[name="destinateur_courrier"]').prop('disabled', true);
    }else{
        $('select[name="destinateur_courrier"]').prop('disabled', false);
    }
  });
});

//Input Destinateur Courrier Edit
$(document).ready(function(){
    $('#fullname_destinateur_edit, #phone_desti_edit').on("input", function() {
    if($("#fullname_destinateur_edit").val().trim() || $('#phone_desti_edit').val().trim()){
        $('select[name="destinateur_courrier_edit"]').prop('disabled', true);
    }else{
        $('select[name="destinateur_courrier_edit"]').prop('disabled', false);
    }
  });
});


//Select Courrier Destinateur Edit
$('select[name="destinateur_courrier_edit"]').on('change', function (e) {
    var valueSelected = this.value;
   if(valueSelected){
    $('#fullname_destinateur_edit').prop('disabled', true);
    $('#phone_desti_edit').prop('disabled', true);
   }else{
    $('#fullname_destinateur_edit').prop('disabled', false);
    $('#phone_desti_edit').prop('disabled', false);
   }
});

//Select Courrier Destinateur Create
$('select[name="destinateur_courrier"]').on('change', function (e) {
    var valueSelected = this.value;
   if(valueSelected){
           $('#fullname_destinateur').val('');
           $('#phone_desti').val('');
           $('#fullname_destinateur').prop('disabled', true);
           $('#phone_desti').prop('disabled', true);
   }else{
       $('#fullname_destinateur').prop('disabled', false);
       $('#phone_desti').prop('disabled', false);
   }
});


//Input Create Courrier Expediteur
$(document).ready(function(){
    $('#destinateur, #telephone_destinateur').on("input", function() {
    if($("#destinateur").val().trim() || $('#telephone_destinateur').val().trim()){
        $('select[name="emetteur_id"]').prop('disabled', true);
    }else{
        $('select[name="emetteur_id"]').prop('disabled', false);
    }
});
})

//Input Edit Courrier Expediteur
$(document).ready(function(){
    $('#destinateurEdit, #telephone_destinateurEdit').on("input", function() {
    if($("#destinateurEdit").val().trim() || $('#telephone_destinateurEdit').val().trim()){
        $('select[name="emetteur_id"]').prop('disabled', true);
    }else{
        $('select[name="emetteur_id"]').prop('disabled', false);
    }
});
})

//Input Edit Courrier Recepteur
$(document).ready(function(){
    $('#destinataireEdit, #telephone_destinataireEdit').on("input", function() {
    if($("#destinataireEdit").val().trim() || $('#telephone_destinataireEdit').val().trim()){
        $('select[name="recepteur_id"]').prop('disabled', true);
    }else{
        $('select[name="recepteur_id"]').prop('disabled', false);
    }
});
})

//Input Create Courrier Recepteur
$(document).ready(function(){
    $('#destinataire, #telephone_destinataire').on("input", function() {
    if($("#destinataire").val().trim() || $('#telephone_destinataire').val().trim()){
        $('select[name="recepteur_id"]').prop('disabled', true);
    }else{
        $('select[name="recepteur_id"]').prop('disabled', false);
    }
});
})

//Select Expediteur Create
$('select[name="emetteur_id"]').on('change', function (e) {
     var valueSelected = this.value;
    if(valueSelected){
            $('#destinateur').val('');
            $('#telephone_destinateur').val('');
            $('#destinateur').prop('disabled', true);
            $('#telephone_destinateur').prop('disabled', true);
    }else{
        $('#destinateur').prop('disabled', false);
        $('#telephone_destinateur').prop('disabled', false);
    }
});

//Select Expediteur Edit
$('select[name="emetteur_id"]').on('change', function (e) {
    var valueSelected = this.value;
   if(valueSelected){
           $('#destinateurEdit').prop('disabled', true);
           $('#telephone_destinateurEdit').prop('disabled', true);
   }else{
            $('#destinateurEdit').prop('disabled', false);
            $('#telephone_destinateurEdit').prop('disabled', false);
}
});


//Select Recepteur Create
$('select[name="recepteur_id"]').on('change', function(e){
    var valueSelected = this.value;
    if(valueSelected){
        $('#destinataire').val('');
        $('#telephone_destinataire').val('');
        $('#destinataire').prop('disabled', true);
        $('#telephone_destinataire').prop('disabled', true);
    }else{
        $('#destinataire').prop('disabled', false);
        $('#telephone_destinataire').prop('disabled', false);
    }
})

//Select Recepteur Edit
$('select[name="recepteur_id"]').on('change', function(e){
    var valueSelected = this.value;
    if(valueSelected){
        $('#destinataireEdit').prop('disabled', true);
        $('#telephone_destinataireEdit').prop('disabled', true);
    }else{
        $('#destinataireEdit').prop('disabled', false);
        $('#telephone_destinataireEdit').prop('disabled', false);
    }
})

//end index page


//index_livraison page
$('#select[name="recepteur_effectif_id"]').on('change', function(e){
    var valueSelected = this.value;
    if($(valueSelected).val()){
        $('#fullname_livraison').attr('disabled', false);
        $('#telephone_livraison').attr('disabled', false);
    }else{
        $('#fullname_livraison').attr('disabled', true);
        $('#telephone_livraison').attr('disabled', true);
    }
});

$('#fullname_livraison, #telephone_livraison').on('input', function(){
    if($('#fullname_livraison').val().trim() || $('#telephone_livraison').val().trim()){
        $('select[name="recepteur_effectif_id"]').prop('disabled', true);
    }else{
        $('select[name="recepteur_effectif_id"]').prop('disabled', false);
    }
});
//end index_livraison page

$(document).on('click', '#btnVoirCourrierClient', function(){
    let courrier = JSON.parse($(this).attr('data-courrier'));
    let vehicules = JSON.parse($(this).attr('data-cars'));

    $('#number_courrier_client').replaceWith(`<span class="badge badge-success" id="number_courrier_client">${courrier.code}</span>`)

    $('#numeroCourrier').val(courrier.code);
    $('#typecourrier').val(courrier.TypeCourrier);
    $('#typenvoi').val(courrier.TypeEnvoie);
    $('#object').val(courrier.objet);
    $('#destinat_courrier').val(courrier.destinateurs ? courrier.destinateurs.fullname : '');
    $('#destinat_telephone').val(courrier.destinateurs ? courrier.destinateurs.telephone : '');
    $('#coursier_courrier_name').val(courrier.coursiers ? courrier.coursiers.fullname : '');
    $('#coursier_courrier_telephone').val(courrier.coursiers ? courrier.coursiers.telephone : '');
    $('#chaufeur').val(courrier.chauffeurs ? courrier.chauffeurs.fullname : '');
    $('#chauffeur_telephone').val(courrier.chauffeurs ? courrier.chauffeurs.telephone : '');
    if(courrier.chauffeurs){
        if(courrier.chauffeurs.vehicule_effectif_id){
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_effectif_id))).Immatriculation);
        }else{
            $('#vehicule_chauffeur').val( (vehicules.find(v => parseInt(v.id) == parseInt(courrier.chauffeurs.vehicule_id))).Immatriculation);
        }
    }   
    $('#emetteur').val(courrier.emetteurs.fullname);
    $('#emetteur_telephone').val(courrier.emetteurs.telephone);
    $('#recepteur').val(courrier.recepteurs.fullname);
    $('#recepteur_telephone').val(courrier.recepteurs.telephone);
    $('#site_exp').val(courrier.site_exps ? courrier.site_exps.intituleSite : '');
    $('#site_recept').val(courrier.site_recepts ? courrier.site_recepts.intituleSite : '');
    $('#statut_cour').val(courrier.status);
    $('#transitoir').val(courrier.Transitoire ? courrier.Transitoire : '');
    $('#date_create').val(courrier.date_create);
    $('#date_retrait_index').val(courrier.DateRetraitCourrier ? courrier.DateRetraitCourrier : '');
    $('#itin_colis').val(courrier.itineraires ? courrier.itineraires.lieux_depart +'-'+ courrier.itineraires.lieux_arrivee +'-'+ courrier.itineraires.duree + 'H' : '');

});
