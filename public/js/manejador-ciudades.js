/*global $*/

$(document).ready(function(){
    $('#provincia').on('change',function(){
        var idProvincia = $(this).val();
        if (idProvincia){
            $.ajax({
                type: 'GET',
                url: '/provincias/' + idProvincia + '/ciudades',
                success:function(html){
                    $('#ciudad').html(html);
                }
            });
        }
        else
            $('#ciudad').html('<option value="">Primero elija una provincia</option>');
    });
});
