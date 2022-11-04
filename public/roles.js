$('#btnSaveRole').on('click', function(){

    let good = true;
    let message = "";

    if(!$('#role').val().trim()){
    good = false;
    message+="Veuillez Renseigner Un Rôle !\n";
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
        url: "createRole",
        data: $('#roleFormInsert').serialize(),
         headers:{
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success: function(data){
            if(data.length == 2){
                let role = data[0];
                $('#dataTable').prepend(`
                <tr>
                    <td> ${role.intituleRole} </td>
                    <td> 
                        <div class='row'>
                            <button class="btn btn-sm btn-info mr-2" data-id=${role.id} data-role=${ role.intituleRole }><span class="icon text-white-80"><i class="fas fa-edit"></i></span>Editer</button>
                            <button class="btn btn-sm btn-danger mr-2"  id="btnDelete" data-id=${role.id}><span class="icon text-white-80"><i class="fas fa-trash"></i></span>Supprimer</button>
                            <button class="btn btn-sm btn-primary" id="btnView"><span class="icon text-white-80"><i class="fas fa-eye mr-2"></i></span>Vue</button>   
                        </div>
                    </td>
                </tr>
                `)
                $("#roleFormInsert")[0].reset();
            }else{
                $('#validation').val(data[0]);
                $('#errorvalidationsModals').attr('data-backdrop', 'static');
                $('#errorvalidationsModals').attr('data-keyboard', false);
                $('#errorvalidationsModals').modal('show');        
            }
        }                
     })
    }    
});

$(document).on('click', '#btnExit', function(){
    location.reload();
});

$(function() { 
    $('#btnFermer').click(function() { 
        $('#roleFormInsert')[0].reset();
    }); 
}); 

$(document).on('click', '#btnEdit', function(){

    let id = $(this).attr('data-id');
    let role = $(this).attr('data-role');
    let description = $(this).attr('data-description');

    $('.form-group #id').val(id);
    $('.form-group #roles').val(role);
    $('.form-group #Descriptions').val(description ? description : '');

    $('#modalEdit').attr('data-backdrop', 'static');
    $('#modalEdit').attr('data-keyboard', 'false');
    $('#modalEdit').modal('show');

})

$('#btnEditRole').on('click', function(){

    let good = true;
    let message = "";

    if(!$('#roles').val().trim()){
        good = false;
        message+="Veuillez Renseigner Un Role !\n";
        }
        
        if(!good){
            good = false;
            alert(message);
        }else{
            $.ajax({
                type: 'POST',
                url: 'editRole',
                data: $('#roleFormEdit').serialize(),
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(){
                        location.reload();
                }
            })
        }
})

$(document).on('click', '#btnDelete', function(){
    if(confirm("Voulez-Vous Vraiment Supprimer Ce Role : "+ $(this).attr('data-intituleRole') +" ?") == true){
            $.ajax({
                type: 'GET',
                url: 'deleteRole',
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

$(document).on('click', '#btnFermer', function(){
    $('#form_roles_add')[0].reset();
});