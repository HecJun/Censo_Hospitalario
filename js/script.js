$(document).ready(function() {
    
    // Cuando el selector de servicios cambie
    $('#servicio').change(function() {
        var servicioId = $(this).val(); // Obtiene el ID del servicio seleccionado    
        
        if (servicioId) {
            // Realiza una solicitud AJAX al archivo ingresos.php
            $.ajax({
                url: '../js/conseguir_subservicios.php', // Archivo PHP que devuelve los subservicios
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
    });

    
    $('#subservicio').change(function() {
        var subservicioId = $(this).val(); 

        if (subservicioId) {
            $.ajax({
                url: '../js/conseguir_cama.php',
                type: 'POST',
                data: { subservicio_id: subservicioId }, 
                success: function(response) {
                    $('#id_cama').html(response);
                },
            });
        } else {
            $('#id_cama').html('<option value="">Seleccione Cama</option');
            }
    });

 //
    $('#servicio_egreso').change(function() {
        var subservicioId = $(this).val(); 

        if (subservicioId) {
            $.ajax({
                url: '../js/conseguir_egreso_subservicios.php',
                type: 'POST',
                data: { servicio_id: subservicioId }, 
                success: function(response) {
                    $('#subservicio_egreso').html(response);
                },
            });
        } else {
            $('#subservicio_egreso').html('<option value="">Seleccione Subservicio</option');
        }
    });

//
    $('#subservicio_egreso').change(function() {
        var subservicioId = $(this).val(); 

        if (subservicioId) {
            $.ajax({
                url: '../js/conseguir_egreso_cama.php',
                type: 'POST',
                data: { subservicio_id: subservicioId }, 
                success: function(response) {
                    $('#id_cama_egreso').html(response);
                },
            });
        } else {
            $('#id_cama_egreso').html('<option value="">Seleccione Cama</option');
        }
    });


    $('#paciente_ingreso').keyup(function(){
        var pacienteId = $('#paciente_ingreso').val();

        if (query.length >= 2) { // Solo busca si se han escrito 2 o más caracteres
            $.ajax({
                url: '../js/buscar_paciente.php',
                method: 'POST',
                data: { paciente_id: pacienteId },
                success: function(response) {  
                    var pacientes = JSON.parse(response);
                    //console.log(pacientes);
                    var datalist = $('#datalistOptions');
                    datalist.empty(); // Limpia las opciones anteriores
                    pacientes.forEach(function(paciente) {
                        datalist.append('<option value="' + paciente.nombre + '" data-id="' + paciente.id + '">');
                    });
                },
            });
        } else {
            $('#datalistOptions').empty();// Limpia el datalist si la búsqueda es muy corta
            }
    });

// Cuando se selecciona una opción del datalist, actualiza el campo oculto con el ID del paciente
    $('#paciente_ingreso').on('input', function() {
        var selectedOption = $('#datalistOptions option[value="' + $(this).val() + '"]');
        if (selectedOption.length > 0) {
            $('#id_paciente').val(selectedOption.data('id'));
        } else {
            $('#id_paciente').val(''); // Limpia el campo si no hay coincidencia
            }
    });
   

    $('#paciente_egreso').keyup(function(){
        var pacienteId = $('#paciente_egreso').val();

        if (query.length >= 2) {
            $.ajax({
                url: '../js/buscar_paciente.php',
                method: 'POST',
                data: { paciente_id: pacienteId },
                success: function(response) {  
                    var pacientes = JSON.parse(response);
                    var datalist = $('#datalistOptions');
                    datalist.empty(); // Limpia las opciones anteriores
                    pacientes.forEach(function(paciente) {
                        datalist.append('<option value="' + paciente.nombre + '" data-id="' + paciente.id + '">');
                    });
                },
            });
        } else {
            $('#datalistOptions').empty();// Limpia el datalist si la búsqueda es muy corta
            }
    });


    $('#paciente_egreso').on('input', function() {
        var selectedOption = $('#datalistOptions option[value="' + $(this).val() + '"]');
        if (selectedOption.length > 0) {
            $('#id_paciente').val(selectedOption.data('id'));
        } else {
            $('#id_paciente').val(''); 
            }
    });

});