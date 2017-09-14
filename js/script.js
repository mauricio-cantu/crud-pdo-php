// Funções para quando a página for carregada por completa
$(function(){

    readRecords();

    // Remover os alertas de validação quando o campo estiver em "focus" (quando for clicado)
    $('.form-control').focus(function(){
        $(this).parent().removeClass('has-error');
        $(this).next().hide();
    });
});


// Exibir registros
function readRecords() {
    $.get("ajax/read.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

function deleteUser(id){

    var c = confirm("Excluir usuário?");

    if(c){
        $.post('ajax/delete.php', {
            id: id
        }, function(){
            readRecords();
        });    
    }
    
}

function getUserDetails(id) {

    $('#hidden_user_id').val(id);

    $.post('ajax/details.php',{
        id: id
    }, function(data, status){
        
        var user = JSON.parse(data);
        
        $("#update_first_name").val(user.first_name);
        $("#update_last_name").val(user.last_name);
        $("#update_email").val(user.email);
    });

    $('#update_user_modal').modal('show');

}

function insert(){

    // pegar valores dos inputs
    var first_name = $("#first_name").val();
    first_name = first_name.trim();
    var last_name = $("#last_name").val();
    last_name = last_name.trim();
    var email = $("#email").val();
    email = email.trim();

    // validação de campos vazios
    if (first_name == "") {
        $('#first_name').parent().addClass('has-error');
        $('#first_name').next().show();

    }
    if (last_name == "") {
        $('#last_name').parent().addClass('has-error');
        $('#last_name').next().show();
    }
    if (email == "") {
        $('#email').parent().addClass('has-error');
        $('#email').next().show();
    }
    else {
        // Se passar, uma requisição POST é feita ao arquivo create.php, 
        // passando as informações pelo body da requisição
        $.post("ajax/create.php", {
            first_name: first_name,
            last_name: last_name,
            email: email
        }, function (data, status) {
            // depois de concluido, fecha o modal de cadastro
            $("#add_new_record_modal").modal("hide");

            // exibe os registros
            readRecords();

            // limpa os campos do modal
            $("#first_name").val("");
            $("#last_name").val("");
            $("#email").val("");
        });
    }

}

function update(){
    
    var first_name = $("#update_first_name").val();
    first_name = first_name.trim();
    var last_name = $("#update_last_name").val();
    last_name = last_name.trim();
    var email = $("#update_email").val();
    email = email.trim();

    // validação de campos vazios
    if (first_name == "") {
        $('#update_first_name').parent().addClass('has-error');
        $('#update_first_name').next().show();

    }
    if (last_name == "") {
        $('#update_last_name').parent().addClass('has-error');
        $('#update_last_name').next().show();
    }
    if (email == "") {
        $('#update_email').parent().addClass('has-error');
        $('#update_email').next().show();
    }
    else {

        var id = $('#hidden_user_id').val();
        $.post("ajax/update.php", {
            first_name: first_name,
            last_name: last_name,
            email: email,
            id: id
        }, function (data, status) {
            
            $("#update_user_modal").modal("hide");

            readRecords();
        });
    }
}
