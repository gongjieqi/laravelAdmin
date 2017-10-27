function deleteUser(id)
{
    var cn = confirm('确认删除这个用户吗？');
    if(cn == true){
        $('.admin-delete-'+id).submit();
    }
}

function deletePermission(id)
{
    var cn = confirm('确认删除这个权限以及该权限下的子目录吗？');
    if(cn == true){
        $('.permission-delete-'+id).submit();
    }
}

function deleteRole(id)
{
    var cn = confirm('确认删除这个角色？');
    if(cn == true){
        $('.role-delete-'+id).submit();
    }
}