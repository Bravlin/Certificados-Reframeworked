/*global $*/

$(document).ready(function(){
    $('#body-certificados').on('click', '.eliminar-certificado', function(){
        if (confirm("¿Está seguro que desea eliminar el certificado indicado?")){
            var idCertif = $(this).attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/certificados/' + idCertif,
                success:function(){
                    var certif = "#certificado-" + idCertif;
                    $(certif).remove();
                }
            });
        }
    });
});
