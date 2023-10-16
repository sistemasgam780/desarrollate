

$(document).ready(function () {
    $('#cp').change(function () {
        $.ajax({
            type: "POST",
            data: "cp=" + $('#cp').val(),
            url: "codigoP.php",
            success: function (r) {
                $('#estado').text(r + " años");
            }
        });
    });
});



/*FUNCION PARA NO ACEPTAR CARACTERES NI Ñ*/

function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patrón de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ñáéíóú]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}






function agregardatos(edat, fecha_contacto, nombre, apellido, amaterno, fechareg, telefono, correo, fuente, referido, resultado_llamada, fecha_cita, hora_cita) {
    cadena = "edat=" + edat +
        "&fecha_contacto=" + fecha_contacto +
        "&nombre=" + nombre +
        "&apellido=" + apellido +
        "&amaterno=" + amaterno +
        "&fechareg=" + fechareg +
        "&telefono=" + telefono +
        "&correo=" + correo +
        "&fuente=" + fuente +
        "&referido=" + referido +
        "&resultado_llamada=" + resultado_llamada +
        "&fecha_cita=" + fecha_cita +
        "&hora_cita=" + hora_cita;
    $.ajax({
        type: "POST",
        url: "php/agregardatos.php",
        data: cadena,
        success: function(r) {
            if (r == 2) {
                alertify.error("El usuario ya existe :(");
                    window.location.href = "existe.php";

            } else if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Agregado con Exito :)");
                window.location.href = "edat.php";
            } else {
                alertify.error("Fallo 1");
            }
        }
    })
}

function agregaform(datos) {
    d = datos.split('||');

    // Usamos los métodos getDate(), getMonth() y getFullYear() para obtener las partes de la fecha en partes y concatenarlas usando el símbolo que queramos y en el orden que queramos.
    let date = new Date(d[3]);
    const formatDate = (date) => {
        let formatted_date = date.getDate() + "/" + ("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear()
        return formatted_date;
    }
    $('#idpersona').val(d[0]);
    $('#nombreu').val(d[1]);
    $('#apellidou').val(d[2]);
    $('#fecharegu').val(formatDate(date));
    $('#telefonou').val(d[4]);
    $('#correou').val(d[5]);
    $('#fuenteu').val(d[6]);
    $('#referidou').val(d[7]);
    $('#resultado_llamadau').val(d[8]);
    $('#fecha_citau').val(d[9]);
    $('#hora_citau').val(d[10]);
    $('#acudio').val(d[11]);
    $('#edad').val(d[12]);
    $('#edo_civil').val(d[13]);
    $('#direccion').val(d[14]);
    $('#dependientes').val(d[15]);
    $('#ocupacion').val(d[16]);
    $('#escolaridad').val(d[17]);
    $('#carrera').val(d[18]);
    $('#institucion').val(d[19]);
    $('#ingreso').val(d[20]);
    $('#trans').val(d[21]);
    $('#tiempo').val(d[22]);
    $('#imagen').val(d[23]);
    $('#caracter').val(d[25]);
    $('#sentido').val(d[26]);
    $('#orientacion').val(d[27]);
    $('#energia').val(d[28]);
    $('#motivacion').val(d[29]);
    $('#perseverancia').val(d[30]);
    $('#suma_vitales').val(d[31]);
    $('#gerente').val(d[32]);
    $('#res_gdd').val(d[33]);
    $('#razon').val(d[34]);
    $('#pp200').val(d[35]);
    $('#pp200_observaciones').val(d[36]);
    $('#comentarios_gdd').val(d[37]);
    $('#estatus').val(d[38]);
    $('#arranque').val(d[39]);
    $('#fecha_induccion').val(d[40]);
    $('#documentacion').val(d[41]);
    $('#conexion').val(d[42]);
    $('#rendimiento').val(d[43]);
    $('#precision').val(d[44]);
    $('#estilo').val(d[45]);
    $('#fecha_conexion1').val(d[46]);
    $('#fecha_contactou').val(d[47]);
    $('#fecha_evaluacion').val(d[48]);
    $('#fecha_ventaCarrera').val(d[49]); //Queda en duda
    $('#fecha_citaIdentidad').val(d[9]); //Queda en duda

}

function agregaform1(reg) {
    r = reg.split('||');
    $('#idpersona').val(r[0]);
    $('#edatu').val(r[1]);
    $('#nombreu').val(r[2]);
    $('#gerenteu').val(r[3]);
    $('#conexionu').val(r[4]);
    $('#fecha_induccionu').val(r[5]);
    $('#fecha_conexionu').val(r[6]);
    $('#fuenteu').val(r[7]);
    $('#fec_real').val(r[8]);
}

function actualizadatos() {
    id = $('#idpersona').val();
    nombre = $('#nombreu').val();
    apellido = $('#apellidou').val();
    telefono = $('#telefonou').val();
    correo = $('#correou').val();
    fuente = $('#fuenteu').val();
    referido = $('#referidou').val();
    resultado_llamada = $('#resultado_llamadau').val();
    fecha_cita = $('#fecha_citau').val();
    hora_cita = $('#hora_citau').val();

    cadena = "id=" + id +
        "&nombre=" + nombre +
        "&apellido=" + apellido +
        "&amaterno=" + amaterno +
        "&telefono=" + telefono +
        "&correo=" + correo +
        "&fuente=" + fuente +
        "&referido=" + referido +
        "&resultado_llamada=" + resultado_llamada +
        "&fecha_cita=" + fecha_cita +
        "&hora_cita=" + hora_cita;
    $.ajax({
        type: "POST",
        url: "php/actualizadatos.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :( al actualizar");
            }
        }
    })
}

function eliminar() {
    id = $('#idpersona').val();
    cadena = "id=" + id;
    $.ajax({
        type: "POST",
        url: "php/eliminar.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Se elimino el registro :)");
            } else {
                alertify.error("Fallo el servidor :( al eliminar");
            }
        }
    });
}

function actualizaficha() {
    id = $('#idpersona').val();
    acudio = $('#acudio').val();
    edad = $('#edad').val();
    estado_civil = $('#edo_civil').val();
    cp = $('#cp').val();
    estado = $('#estado').val();
    municipio = $('#municipio').val();
    colonia = $('#colonia').val();
    alcaldia = $('#direccion').val();
    dependientes = $('#dependientes').val();
    ocupacion = $('#ocupacion').val();
    escolaridad = $('#escolaridad').val();
    carrera = $('#carrera').val();
    institucion = $('#institucion').val();
    ingreso = $('#ingreso').val();
    trans = $('#trans').val();
    tiempo = $('#tiempo').val();
    imagen = $('#imagen').val();
    fecha_nacimiento = $('#fechaNacimiento').val();
    genero = $('#genero').val();
    nacionalidad = $('#nacionalidad').val();
    

    cadena = "id=" + id +
        "&acudio=" + acudio +
        "&edad=" + edad +
        "&estado_civil=" + estado_civil +
        "&cp=" + cp +
        "&estado=" + estado +
        "&municipio=" + municipio +
        "&colonia=" + colonia +
        "&alcaldia=" + alcaldia +
        "&dependientes=" + dependientes +
        "&ocupacion=" + ocupacion +
        "&escolaridad=" + escolaridad +
        "&carrera=" + carrera +
        "&institucion=" + institucion +
        "&ingreso=" + ingreso +
        "&trans=" + trans +
        "&tiempo=" + tiempo +
        "&fecha_nacimiento=" + fecha_nacimiento +
        "&imagen=" + imagen +
        "&genero=" + genero +
        "&nacionalidad=" + nacionalidad;
    $.ajax({
        type: "POST",
        url: "php/actualizaficha.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :( en ficha identidad");
            }
        }
    })
}

function actualizafactores() {
    id = $('#idpersona').val();
    fecha_evaluacion = $('#fecha_evaluacion').val();
    caracter = $('#caracter').val();
    sentido = $('#sentido').val();
    orientacion = $('#orientacion').val();
    energia = $('#energia').val();
    motivacion = $('#motivacion').val();
    perseverancia = $('#perseverancia').val();
    suma_vitales = $('#suma_vitales').val();

    cadena = "id=" + id +
        "&fecha_evaluacion=" + fecha_evaluacion +
        "&caracter=" + caracter +
        "&sentido=" + sentido +
        "&orientacion=" + orientacion +
        "&energia=" + energia +
        "&motivacion=" + motivacion +
        "&perseverancia=" + perseverancia +
        "&suma_vitales=" + suma_vitales;

    $.ajax({
        type: "POST",
        url: "php/actualizafactores.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :( al actualizar factores");
            }
        }
    })
}

function actualizako() {
    id = $('#idpersona').val();
    var insert = [];
    $('.get_value').each(function() {
        if ($(this).is(":checked")) {
            insert.push($(this).val());
        }
    });

    cadena = "id=" + id +
        "&insert=" + insert;
    $.ajax({
        type: "POST",
        url: "php/actualizaknowout.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function actualizapotencial() {

    id = $('#idpersona').val();
    sumapotencial = $('#sumapotencial').val();
    mensajepotencial = $('#mensajepotencial').val();

    cadena = "id=" + id +
        "&sumapotencial=" + sumapotencial +
        "&mensajepotencial=" + mensajepotencial;
    $.ajax({
        type: "POST",
        url: "php/actualizapotencial.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function actualizapsp() {

    id = $('#idpersona').val();
    rendimiento = $('#rendimiento').val();
    precision = $('#precision').val();
    estilo = $('#estilo').val();

    cadena = "id=" + id +
        "&rendimiento=" + rendimiento +
        "&precision=" + precision +
        "&estilo=" + estilo;
    $.ajax({
        type: "POST",
        url: "php/actualizapsp.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
                location.reload(true);
            } else {
                alertify.error("Fallo el servidor :(");
                location.reload(true);
            }
        }
    })
}

function actualizagdd() {

    id = $('#idpersona').val();
    fecha_ventaCarrera = $('#fecha_ventaCarrera').val();
    gerente = $('#gerente').val();
    res_gdd = $('#res_gdd').val();
    razon = $('#razon').val();
    pp200 = $('#pp200').val();
    pp200_observaciones = $('#pp200_observaciones').val();
    comentarios_gdd = $('#comentarios_gdd').val();

    cadena = "id=" + id +
        "&fecha_ventaCarrera=" + fecha_ventaCarrera +
        "&gerente=" + gerente +
        "&res_gdd=" + res_gdd +
        "&razon=" + razon +
        "&pp200=" + pp200 +
        "&pp200_observaciones=" + pp200_observaciones +
        "&comentarios_gdd=" + comentarios_gdd;
    $.ajax({
        type: "POST",
        url: "php/actualizagdd.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function actualizaresultado() {
    id = $('#idpersona').val();
    estatus = $('#estatus').val();
    arranque = $('#arranque').val();
    fecha_induccion = $('#fecha_induccion').val();
    documentacion = $('#documentacion').val();

    cadena = "id=" + id +
        "&estatus=" + estatus +
        "&arranque=" + arranque +
        "&fecha_induccion=" + fecha_induccion +
        "&documentacion=" + documentacion;
    $.ajax({
        type: "POST",
        url: "php/actualizaresultado.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function actualizacnx() {
    id = $('#idpersona').val();
    conexion = $('#conexion').val();
    fecha_conexion = $('#fecha_conexion').val();
    cadena = "id=" + id +
        "&conexion=" + conexion +
        "&fecha_conexion=" + fecha_conexion;
    $.ajax({
        type: "POST",
        url: "php/actualizacnx.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#tabla').load('componentes/tabla.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
                alertify.error(fecha_conexion);
            }

        }
    })
}

function actualizametas() {
    nombrem = $('#nombrem').val();
    dmmc = $('#dmmc').val();
    dmtc = $('#dmtc').val();
    dmac = $('#dmac').val();
    dmmci = $('#dmmci').val();
    dmtci = $('#dmtci').val();
    dmaci = $('#dmaci').val();
    dmmarra = $('#dmmarra').val();
    dmtarra = $('#dmtarra').val();
    dmaarra = $('#dmaarra').val();
    dmmco = $('#dmmco').val();
    dmtco = $('#dmtco').val();
    dmaco = $('#dmaco').val();

    cadena = "nombrem=" + nombrem +
        "&dmmc=" + dmmc +
        "&dmtc=" + dmtc +
        "&dmac=" + dmac +
        "&dmmci=" + dmmci +
        "&dmtci=" + dmtci +
        "&dmaci=" + dmaci +
        "&dmmco=" + dmmco +
        "&dmtco=" + dmtco +
        "&dmaco=" + dmaco +
        "&dmmarra=" + dmmarra +
        "&dmtarra=" + dmtarra +
        "&dmaarra=" + dmaarra;
    $.ajax({
        type: "POST",
        url: "php/metas.php",
        data: cadena,
        success: function(r) {

            if (r == 1) {
                $('#contenedor').load('../admin.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function agregausuario() {
    nombreuser = $('#nombreuser').val();
    passuser = $('#passuser').val();
    tipouser = $('#tipouser').val();

    cadena = "nombreuser=" + nombreuser +
        "&passuser=" + passuser +
        "&tipouser=" + tipouser;
    $.ajax({
        type: "POST",
        url: "php/agregauser.php",
        data: cadena,
        success: function(r) {
            if (r == 1) {
                $('#contenedor').load('../admin.php');
                alertify.success("Actualizado con Exito :)");
            } else {
                alertify.error("Fallo el servidor :(");
            }
        }
    })
}

function reload(segs) {
    setTimeout(function() {
        location.reload();
    }, parseInt(segs) * 1000);
}