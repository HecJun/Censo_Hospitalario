$(document).ready(function() {
    
    
    // Cuando el selector de servicios cambie
    $('#servicio').change(function() {
        var servicioId = $(this).val(); // Obtiene el ID del servicio seleccionado
        if (servicioId) {
            // Realiza una solicitud AJAX al archivo ingresos.php
            $.ajax({
                url: '../pages/ingresos.php', // Archivo PHP que devuelve los subservicios
                type: 'POST',
                data: { servicio_id: servicioId }, // Envía el ID del servicio
                success: function(response) {
                    // Inserta las opciones devueltas en el selector de subservicios
                    $('#subservicio').html(response);
                },
            });
        } else {
            // Si no se selecciona un servicio, limpia el selector de subservicios
            $('#subservicio').html('<option value="">Seleccione Subservicio</option');
        }
    })

    
    
    
    $('#paciente').keyup(function(){
        var pacienteID = $('#paciente').val();
        $.ajax({
            url: '../pages/ingresos.php',
            type: 'POST',
            data: { paciente_id: pacienteID },
            success: function(response) {
                $('#paciente').html(response);
            }
        });

    })

});