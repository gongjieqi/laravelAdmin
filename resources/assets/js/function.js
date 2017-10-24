function deleteUser(id)
{
    var cn = confirm('确认删除这个用户吗？');
    if(cn == true){
        $('.admin-delete-'+id).submit();
    }
}