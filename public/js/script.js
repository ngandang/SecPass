function edit(id, name,username,url,password, description){
    $('#id').val(id);
    $('#name').val(name);
    $('#url').val(username);
    $('#username').val(url);
    $('#password').val(password);
    $('#description').val(description);
    $('#editForm').show();
}
function del(id){
    $('#idDelete').val(id);
}
function share(id)
{
    $('#idShare').val(id);
}