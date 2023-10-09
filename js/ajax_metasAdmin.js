 // ************ */ AJAX PARA SECCIONES DE OBJETIVOS /* ************ 

 $(document).ready(function() {
     //Actualizar metas/Objetivos Generales
     $('#modificarObj').click(function() {
         var recolec = $('#datosGenerales_obj').serialize();
         // alert(recolec);
         $.ajax({
             type: "POST",
             url: "modificar_ogAdmin.php",
             data: recolec,
             success: function(variable) {
                 $('#objetivosG').load('metas_admin.php #tabladinamicaloadObj'); // Actualiza solo el div de la tablas
                 $('#objEspecificos_A').load('metas_admin.php #tabladinamicaloadObj_A'); // Actualiza solo el div de la tabla/objetivos especificos
                 $('#objEspecificos_N').load('metas_admin.php #tabladinamicaloadObj_N'); // Actualiza solo el div de la tabla/objetivos especificos
                 $('#objEspecificos_P').load('metas_admin.php #tabladinamicaloadObj_P'); // Actualiza solo el div de la tabla/objetivos especificos
                 $('#objEspecificos_Y').load('metas_admin.php #tabladinamicaloadObj_Y'); // Actualiza solo el div de la tabla/objetivos especificos
                 $('#refrescarModal_A').load('metas_admin.php #refrescarModal_A'); // Actualiza solo el div del modal-body/Alan
                 $('#refrescarModal_N').load('metas_admin.php #refrescarModal_N'); // Actualiza solo el div del modal-body/Nallely
                 $('#refrescarModal_P').load('metas_admin.php #refrescarModal_P'); // Actualiza solo el div del modal-body/Paloma
                 $('#refrescarModal_Y').load('metas_admin.php #refrescarModal_Y'); // Actualiza solo el div del modal-body/Yazmin
                 $('#exampleModal').modal('hide'); // Oculta modal sin refrescar la ventana
             }
         })
     });

     //Actualizar metas/Objetivos Especificos 
     $('#modificarObj_esp').click(function() {
         var recolec = $('#datosEspecificos_obj').serialize();
         // alert(recolec);
         $.ajax({
             type: "POST",
             url: "modificar_oespAdmin.php",
             data: recolec,
             success: function(variable) {
                 $('#objEspecificos_A').load('metas_admin.php #tabladinamicaloadObj_A'); // Actualiza solo el div de la tabla
                 $('#objEspecificos_N').load('metas_admin.php #tabladinamicaloadObj_N'); // Actualiza solo el div de la tabla
                 $('#objEspecificos_P').load('metas_admin.php #tabladinamicaloadObj_P'); // Actualiza solo el div de la tabla
                 $('#objEspecificos_Y').load('metas_admin.php #tabladinamicaloadObj_Y'); // Actualiza solo el div de la tabla              
                 $('#objEsp').modal('hide'); // Oculta modal sin refrescar la ventana
                 document.getElementById("edat_obj").selectedIndex = 0; // Vuelca en 0 al select cuando se cierra
                 document.getElementById("espObj_a").style.display = "none"; // Oculta la sección correspondiente a Alan 
                 document.getElementById("espObj_n").style.display = "none"; // Oculta la sección correspondiente a Nallely
                 document.getElementById("espObj_p").style.display = "none"; // Oculta la sección correspondiente a Paloma
                 document.getElementById("espObj_y").style.display = "none"; // Oculta la sección correspondiente a Yazmin
                 $('#modificarObj_esp').attr('disabled', true); // deshabilita boton al cerrarse el modal
             }
         })
     });


     // ************ */ AJAX PARA SECCIONES DE PONDERACIÓN /* ************ 

     //Actualizar metas/Ponderacion General
     $('#modificarPond').click(function() {
         // Seleccion del valor por elemento
         var contactos = $('input[name=contactosPg]').val();
         var entrevistas = $('input[name=entrevistasPg]').val();
         var evaluaciones = $('input[name=evaluacionesPg]').val();
         var ventas = $('input[name=ventasPg]').val();
         var inducciones = $('input[name=induccionesPg]').val();
         var conexiones = $('input[name=conexionesPg]').val();

         var resultado = parseInt(contactos) + parseInt(entrevistas) + parseInt(evaluaciones) + parseInt(ventas) + parseInt(inducciones) + parseInt(conexiones); // suma la seleccion de los elementos detectando que sean solo números

         //Ingresamos alerta su supera la ponderacion asignada que es 100
         if (resultado <= 99 || resultado >= 101) {
             swal({
                 title: "¡Error!",
                 text: "El total de puntos debe ser 100 exactos",
                 type: "error",
                 customClass: 'swal-wide',
                 allowOutsideClick: false
             });
         } else {
             var recolecPon = $('#datosGenerales_pon').serialize();
             $.ajax({
                 type: "POST",
                 url: "modificar_pgAdmin.php",
                 data: recolecPon,
                 success: function(variable) {
                     $('#ponderacionG').load('metas_admin.php #tabladinamicaloadPon'); // Actualiza solo el div de la tablas
                     $('#ponEspecificos_A').load('metas_admin.php #tabladinamicaloadPon_A'); // Actualiza solo el div de la tabla/ponderacion especifica
                     $('#ponEspecificos_N').load('metas_admin.php #tabladinamicaloadPon_N'); // Actualiza solo el div de la tabla/ponderacion especifica
                     $('#ponEspecificos_P').load('metas_admin.php #tabladinamicaloadPon_P'); // Actualiza solo el div de la tabla/ponderacion especifica
                     $('#ponEspecificos_Y').load('metas_admin.php #tabladinamicaloadPon_Y'); // Actualiza solo el div de la tabla/ponderacion especifica
                     $('#refrescarModalPonEsp_A').load('metas_admin.php #refrescarModalPonEsp_A'); // Actualiza solo el div del modal-body/Alan
                     $('#refrescarModalPonEsp_N').load('metas_admin.php #refrescarModalPonEsp_N'); // Actualiza solo el div del modal-body/Nallely
                     $('#refrescarModalPonEsp_P').load('metas_admin.php #refrescarModalPonEsp_P'); // Actualiza solo el div del modal-body/Paloma
                     $('#refrescarModalPonEsp_Y').load('metas_admin.php #refrescarModalPonEsp_Y'); // Actualiza solo el div del modal-body/Yazmin
                     $('#pondeGen').modal('hide'); // Oculta modal sin refrescar la ventana
                 }
             })
         }
     });


     //Actualizar metas/Ponderaciones Especificas 
     $('#modificarPon_esp').click(function() {

         // Seleccion del valor por elemento-ALAN
         var contactosA = $('input[name=contactosA_ponE]').val();
         var entrevistasA = $('input[name=entrevistasA_ponE]').val();
         var evaluacionesA = $('input[name=evaluacionesA_ponE]').val();
         var ventasA = $('input[name=ventasA_ponE]').val();
         var induccionesA = $('input[name=induccionesA_ponE]').val();
         var conexionesA = $('input[name=conexionesA_ponE]').val();

         var resultadoA = parseInt(contactosA) + parseInt(entrevistasA) + parseInt(evaluacionesA) + parseInt(ventasA) + parseInt(induccionesA) + parseInt(conexionesA); // suma la seleccion de los elementos detectando que sean solo números

         // Seleccion del valor por elemento-NALLELY QUINTANA
         var contactosN = $('input[name=contactosN_ponE]').val();
         var entrevistasN = $('input[name=entrevistasN_ponE]').val();
         var evaluacionesN = $('input[name=evaluacionesN_ponE]').val();
         var ventasN = $('input[name=ventasN_ponE]').val();
         var induccionesN = $('input[name=induccionesN_ponE]').val();
         var conexionesN = $('input[name=conexionesN_ponE]').val();

         var resultadoN = parseInt(contactosN) + parseInt(entrevistasN) + parseInt(evaluacionesN) + parseInt(ventasN) + parseInt(induccionesN) + parseInt(conexionesN); // suma la seleccion de los elementos detectando que sean solo números

         // Seleccion del valor por elemento-PALOMA RAZO
         var contactosP = $('input[name=contactosP_ponE]').val();
         var entrevistasP = $('input[name=entrevistasP_ponE]').val();
         var evaluacionesP = $('input[name=evaluacionesP_ponE]').val();
         var ventasP = $('input[name=ventasP_ponE]').val();
         var induccionesP = $('input[name=induccionesP_ponE]').val();
         var conexionesP = $('input[name=conexionesP_ponE]').val();

         var resultadoP = parseInt(contactosP) + parseInt(entrevistasP) + parseInt(evaluacionesP) + parseInt(ventasP) + parseInt(induccionesP) + parseInt(conexionesP); // suma la seleccion de los elementos detectando que sean solo números


         // Seleccion del valor por elemento-YAZMIN ALBARRAN
         var contactosY = $('input[name=contactosY_ponE]').val();
         var entrevistasY = $('input[name=entrevistasY_ponE]').val();
         var evaluacionesY = $('input[name=evaluacionesY_ponE]').val();
         var ventasY = $('input[name=ventasY_ponE]').val();
         var induccionesY = $('input[name=induccionesY_ponE]').val();
         var conexionesY = $('input[name=conexionesY_ponE]').val();

         var resultadoY = parseInt(contactosY) + parseInt(entrevistasY) + parseInt(evaluacionesY) + parseInt(ventasY) + parseInt(induccionesY) + parseInt(conexionesY); // suma la seleccion de los elementos detectando que sean solo números
         getSelectValue = document.getElementById("edat_pon").value; // Trae el nombre del EDAT que seleccione

         //  Alertas
         if (getSelectValue == "Alan Soto" && resultadoA <= 99 || resultadoA >= 101) {
             swal({
                 title: "¡Error!",
                 text: "El total de puntos para Alan debe ser 100 exactos",
                 type: "error",
                 customClass: 'swal-wide',
                 allowOutsideClick: false
             });
         } else if (getSelectValue == "Nallely Quintana" && resultadoN <= 99 || resultadoN >= 101) {
             swal({
                 title: "¡Error!",
                 text: "El total de puntos para Nallely debe ser 100 exactos",
                 type: "error",
                 customClass: 'swal-wide',
                 allowOutsideClick: false
             });
         } else if (getSelectValue == "Paloma Razo" && resultadoP <= 99 || resultadoP >= 101) {
             swal({
                 title: "¡Error!",
                 text: "El total de puntos para Paloma debe ser 100 exactos",
                 type: "error",
                 customClass: 'swal-wide',
                 allowOutsideClick: false
             });
         } else if (getSelectValue == "Yazmin Albarran" && resultadoY <= 99 || resultadoY >= 101) {
             swal({
                 title: "¡Error!",
                 text: "El total de puntos para Yazmin debe ser 100 exactos",
                 type: "error",
                 customClass: 'swal-wide',
                 allowOutsideClick: false
             });
         } else {
             var recolecPon_esp = $('#datosEspecificos_pon').serialize();
             $.ajax({
                 type: "POST",
                 url: "modificar_pespAdmin.php",
                 data: recolecPon_esp,
                 success: function(variable) {
                     $('#ponEspecificos_A').load('metas_admin.php #tabladinamicaloadPon_A'); // Actualiza solo el div de la tabla
                     $('#ponEspecificos_N').load('metas_admin.php #tabladinamicaloadPon_N'); // Actualiza solo el div de la tabla
                     $('#ponEspecificos_P').load('metas_admin.php #tabladinamicaloadPon_P'); // Actualiza solo el div de la tabla
                     $('#ponEspecificos_Y').load('metas_admin.php #tabladinamicaloadPon_Y'); // Actualiza solo el div de la tabla              
                     $('#ponEsp').modal('hide'); // Oculta modal sin refrescar la ventana
                     document.getElementById("edat_pon").selectedIndex = 0; // Vuelca en 0 al select cuando se cierra
                     document.getElementById("espPon_a").style.display = "none"; // Oculta la sección correspondiente a Alan 
                     document.getElementById("espPon_n").style.display = "none"; // Oculta la sección correspondiente a Nallely
                     document.getElementById("espPon_p").style.display = "none"; // Oculta la sección correspondiente a Paloma
                     document.getElementById("espPon_y").style.display = "none"; // Oculta la sección correspondiente a Yazmin
                     //  alert(variable);
                     $('#modificarObj').attr('disabled', false); // deshabilita boton al cerrarse el modal
                     $('#modificarPon_esp').attr('disabled', true);
                     $('#modificarObj_esp').attr('disabled', true); // deshabilita boton al cerrarse el modal
                 }
             })
         }
     });


     //  Al oprimir el boton de cerrar en los modales-especificos vuelca en 0 todo el formulario y deshabilita el btn de modificar
     $('.close').click(function() {
         // OBJETIVOS-Especificos
         document.getElementById("edat_obj").selectedIndex = 0; // Vuelca en 0 al select cuando se cierra
         document.getElementById("espObj_a").style.display = "none"; // Oculta la sección correspondiente a Alan 
         document.getElementById("espObj_n").style.display = "none"; // Oculta la sección correspondiente a Nallely
         document.getElementById("espObj_p").style.display = "none"; // Oculta la sección correspondiente a Paloma
         document.getElementById("espObj_y").style.display = "none"; // Oculta la sección correspondiente a Yazmin
         $('#modificarObj_esp').attr('disabled', true);
         // PONDERACION-Especificos
         document.getElementById("edat_pon").selectedIndex = 0; // Vuelca en 0 al select cuando se cierra
         document.getElementById("espPon_a").style.display = "none"; // Oculta la sección correspondiente a Alan 
         document.getElementById("espPon_n").style.display = "none"; // Oculta la sección correspondiente a Nallely
         document.getElementById("espPon_p").style.display = "none"; // Oculta la sección correspondiente a Paloma
         document.getElementById("espPon_y").style.display = "none"; // Oculta la sección correspondiente a Yazmin
         $('#modificarPon_esp').attr('disabled', true);
     });


     // Deshabilita el boton de ponderacion/general si esta vacio o en cero el input
     $('.form-control').on('input change', function() {
         var a = $('input[name=contactosPg]').val(),
             b = $('input[name=entrevistasPg]').val(),
             c = $('input[name=evaluacionesPg]').val(),
             d = $('input[name=ventasPg]').val(),
             e = $('input[name=induccionesPg]').val(),
             f = $('input[name=conexionesPg]').val();

         if (a == '' || a == '0' || b == '' || b == '0' || c == '' || c == '0' || d == '' || d == '0' || e == '' || e == '0' || f == '' || f == '0') {
             $('#modificarPond').prop('disabled', true);
         } else {
             $('#modificarPond').prop('disabled', false);
         }
     });


 });