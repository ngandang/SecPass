function edit(id, name,username,url,password, description){
    $('#idEdit').val(id);
    $('#nameEdit').val(name);
    $('#usernameEdit').val(username);
    $('#urlEdit').val(url);
    $('#passwordEdit').val(password);
    $('#descriptionEdit').val(description);
    $('#editForm').show();
}
function del(id){
    $('#idDelete').val(id);
}
function share(id)
{
    $('$idShare').val(id);
}

