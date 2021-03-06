/*global $*/

$(document).ready(function(){
    $('#eliminar-evento').on('click', function(){
        if (confirm('¿Está seguro de que desea eliminar este evento?')){
            var idEvento = $('#id_evento').attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/eventos/' + idEvento,
                success:function(){
                    window.location.replace("/eventos");
                }
            });
        }
    });

    $('#select-perfil').on('change', function(){
        var idPerfil = $('#select-perfil').val();
        var tipo = $('#select-tipo').val();
        if (idPerfil != "" && tipo != "")
            $('#boton-inscribir').prop("disabled", false);
        else
            $('#boton-inscribir').prop("disabled", true);
    });

    $('#select-tipo').on('change', function(){
        var idPerfil = $('#select-perfil').val();
        var tipo = $('#select-tipo').val();
        if (idPerfil != "" && tipo != "")
            $('#boton-inscribir').prop("disabled", false);
        else
            $('#boton-inscribir').prop("disabled", true);
    });

    $('#boton-inscribir').on('click', function(){
        var idEvento = $('#id_evento').attr('valor');
        var idPerfil = $('#select-perfil').val();
        var tipo = $('#select-tipo').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/inscripciones',
            data: {
                idEvento: idEvento,
                idPerfil: idPerfil,
                tipo: tipo
            },
            success:function(html){
                $('#body-inscripciones').prepend(html);
                $('#boton-inscribir').prop("disabled", true);
            }
        });
    });

    $('#body-inscripciones').on('click', '.eliminar-inscripcion', function(){
        if (confirm("¿Está seguro que desea eliminar la inscripción indicada?")){
            var idInscrip = $(this).attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/inscripciones/' + idInscrip,
                success:function(){
                    var inscrip = "#inscripcion-" + idInscrip;
                    $(inscrip).remove();
                }
            });
        }
    });

    /*
    $('#body-inscripciones').on('click', '.emitir-cert', function(){
        var idInscrip = $(this).attr('valor');
        $.ajax({
            type: 'POST',
            url: 'lib/manejador-certificados.php',
            data: {
                accion: "I",
                idInscrip: idInscrip,
            },
            success:function(){
                $.ajax({
                    type: 'POST',
                    url: 'lib/manejador-email.php',
                    data: {
                        accion: "I",
                        idInscrip: idInscrip,
                    },
                    success:function(){
                        alert("Certificado enviado con éxito.")
                    }
                });
            }
        })
    });
    */

    $('#body-inscripciones').on('change', '.select-asistencia', function(){
        var idInscrip = $(this).attr('valor');
        var asistencia = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PATCH',
            url: '/inscripciones/' + idInscrip,
            data: {
                asistencia: asistencia
            },
            success:function(){
                var emitirBoton = "#emitir-i" + idInscrip;
                $(emitirBoton).prop("disabled", asistencia != 1);
            }
        });
    });

    $('#subir-template').on('click', function(){
        var idEvento = $('#id_evento').attr('valor');
        var formData = new FormData();
        formData.append('template', $('input[type=file]')[0].files[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/eventos/' + idEvento + '/template',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(){
                alert('Template subido correctamente.');
            }
        });
    });

    $('#generar-todos').on('click', function(){
        var idEvento = $('#id_evento').attr('valor');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/eventos/' + idEvento + '/certificados',
            success:function(){
                alert('Certificados generados.');
            }
        });
    });

    /*
    $('#emitir-todos').on('click', function(e){
        var idEvento = $('#id_evento').attr('valor');
        $.ajax({
            type: 'POST',
            url: 'lib/manejador-email.php',
            data: {
                accion: 'T',
                idEvento: idEvento,
            },
            success:function(){
                alert("Certificados enviados.");
            }
        });
    });
    */

    $('#form-mail').on('submit', function(e){
        e.preventDefault();
        var datosMail = $(this).serialize();
        if (!$('#emitir-todos').attr('hidden')){
            var idEvento = $('#id_evento').attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/emails/eventos/' + idEvento,
                data: datosMail,
                success:function(){
                    alert("Certificados enviados.");
                }
            });
        }
        else if (!$('#emitir-uno').attr('hidden')){
            var idInscrip = $('#emitir-uno').attr('valor');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/certificados/inscripciones/' + idInscrip,
                success:function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/emails/inscripciones/' + idInscrip,
                        data: datosMail,
                        success:function(){
                            alert("Certificado enviado con éxito.")
                        }
                    });
                }
            });
        }
    });

    $('#body-inscripciones').on('click', '.email-ind', function(){
        var idInscrip = $(this).attr('valor');
        $('#emitir-uno').attr('valor', idInscrip);
        $('#emitir-uno').attr('hidden', false);
        $('#emitir-todos').attr('hidden', true);
    });

    $('#email-todos').on('click', function(){
        $('#emitir-uno').attr('hidden', true);
        $('#emitir-todos').attr('hidden', false);
    });
});
