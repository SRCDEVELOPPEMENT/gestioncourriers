$("#btnSaveStatut").on('click', function(){

    let status = JSON.parse($('button[name="btnstats"]').attr('data-statuts'));
    
    let good = true;
    let message = "";

    if(!$('#statut').val().trim())
    {
        good = false;
        message += "Veuillez Renseigner Un Statut !";
    }else{
        let yes = true;
        status.forEach(stat => {
            if(stat.IntituleStatut.toLowerCase() == $('#statut').val().trim().toLowerCase()){
                yes = false;
            }
        });
        if(!yes){
            good = false;
            message += "Veuillez Renseigner Un Autre Statut Car Déja Existant !";    
        }
    }
    if(!good){
        good = false;
        alert(message);
    }else{
        $.ajax({
            type: 'POST',
            url: 'createStatut',
            data: $('#statutFormInsert').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(statut){
                if(statut){
                    $('#dataTable').prepend(`
                                    <tr>
                                        <td><span style="font-weight:bold;"><label class="badge badge-info">${statut.IntituleStatut}</label></span></td>
                                        <td> ${statut.DescriptionStatut ? statut.DescriptionStatut : ''} </td>
                                        <td> 
                                            <div class='row ml-3'>
                                                <button class="btn btn-info mr-2" type="button" id="btnEdit" data-id=${statut.id} data-IntituleStatut=${statut.IntituleStatut} data-DescriptionStatut=${statut.DescriptionStatut}><span class="icon text-white-80"><i class="fas fa-edit"></i></span></button>    
                                                <button class="btn btn-danger" id="btnDelete" data-id=${statut.id }><span class="icon text-white-80"><i class="fas fa-trash"></i></span></button>
                                                <button class="btn btn-primary" id="btnView"><span class="icon text-white-80"><i class="fas fa-eye"></i></span></button>
                                            </div>
                                        </td>
                                    </tr>
                    `);
                   $('#statutFormInsert')[0].reset();
                }
            }
        });
    }
});


$(document).on('click', '#btnEdit', function(){

    let id = $(this).attr('data-id');
    let statut = $(this).attr('data-IntituleStatut');
    let description = $(this).attr('data-DescriptionStatut') ? $(this).attr('data-DescriptionStatut') : '';

    $("#statutFormEdit")[0].reset();
    
    $('.form-group #id').val(id);
    $('.form-group #statuts').val(statut);
    $('.form-group #Descriptions').val(description ? description : '');
    
    $('#modalEditStatut').attr('data-backdrop', 'static');
    $('#modalEditStatut').attr('data-keyboard', 'false');
    $('#modalEditStatut').modal('show');

})

$(document).on('click', '#btnDelete', function(){
    if(confirm("Voulez-Vous Vraiment Supprimer Ce Statut ?") == true){
        $.ajax({
            type: 'GET',
            url: 'deleteStatut',
            data: {id: $(this).attr('data-id')},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(){
                location.reload();
            }
        })
    }
})

$('#btnEditStatut').on('click', function(){

    let good = true;
    let message = "";

    if(!$('#statuts').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Statut !\n";
        }
        
        if(!good){
            good = false;
            alert(message);
        }else{
            $.ajax({
                type: 'POST',
                url: 'editStatut',
                data: $('#statutFormEdit').serialize(),
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(){
                        location.reload();
                }
            })
        }
})

$(document).on('click', '#btnExit', function(){
    location.reload();
})

$(function() { 

    $('#btnClose, #btnExit').click(function() { 
        $('#statutFormInsert')[0].reset();
    }); 
}); 
