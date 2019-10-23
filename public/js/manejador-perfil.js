/*global $*/

$(document).ready(function(){
    $('#body-perfiles').on('click', '.eliminar-perfil', function(){
        if (confirm("¿Está seguro que desea eliminar el perfil indicado?")){
            var idPerfil = $(this).attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/perfiles/' + idPerfil,
                success:function(){
                    var perfil = "#perfil-" + idPerfil;
                    $(perfil).remove();
                }
            });
        }
    })
});
