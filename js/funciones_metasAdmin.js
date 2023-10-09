// FUNCIONES PARA SECCION DE OBJETIVOS

function showSelect_obj() {
    var objetivo = document.getElementById("select_obj");
    var ponderacion = document.getElementById("select_pond");
    var tablaObj_g = document.getElementById("tableObj_General");
    var tableObj_Esp = document.getElementById("tableObj_Esp");
    var tablePon_General = document.getElementById("tablePon_General");
    var tablePon_Esp = document.getElementById("tablePon_Esp");
    if (objetivo.style.display === "none") {
        objetivo.style.display = "block";
        ponderacion.style.display = "none";
        tablaObj_g.style.display = "none";
        tableObj_Esp.style.display = "none";
        tablePon_General.style.display = "none";
        tablePon_Esp.style.display = "none";
        document.getElementById("result_obj").selectedIndex = 0;
    }
}

function showObj() {
    getSelectValue = document.getElementById("result_obj").value;
    if (getSelectValue == "obj_gen") {
        document.getElementById("tableObj_General").style.display = "block";
        document.getElementById("tableObj_Esp").style.display = "none";
    }
    if (getSelectValue == "obj_esp") {
        document.getElementById("tableObj_General").style.display = "none";
        document.getElementById("tableObj_Esp").style.display = "block";

    }
}

function showObj_esp() {
    getSelectValue = document.getElementById("edat_obj").value;
    if (getSelectValue == "Alan Soto") {
        document.getElementById("espObj_a").style.display = "block";
        document.getElementById("espObj_n").style.display = "none";
        document.getElementById("espObj_p").style.display = "none";
        document.getElementById("espObj_y").style.display = "none";
        $('#modificarObj_esp').prop('disabled', false);
    } else if (getSelectValue == "Nallely Quintana") {
        document.getElementById("espObj_a").style.display = "none";
        document.getElementById("espObj_n").style.display = "block";
        document.getElementById("espObj_p").style.display = "none";
        document.getElementById("espObj_y").style.display = "none";
        $('#modificarObj_esp').prop('disabled', false);
    } else if (getSelectValue == "Paloma Razo") {
        document.getElementById("espObj_a").style.display = "none";
        document.getElementById("espObj_n").style.display = "none";
        document.getElementById("espObj_p").style.display = "block";
        document.getElementById("espObj_y").style.display = "none";
        $('#modificarObj_esp').prop('disabled', false);
    } else {
        document.getElementById("espObj_a").style.display = "none";
        document.getElementById("espObj_n").style.display = "none";
        document.getElementById("espObj_p").style.display = "none";
        document.getElementById("espObj_y").style.display = "block";
        $('#modificarObj_esp').prop('disabled', false);
    }
}

// FUNCIONES PARA SECCION DE PONDERACIONES

function showSelect_pond() {
    var ponderacion = document.getElementById("select_pond");
    var objetivo = document.getElementById("select_obj");
    var tablaObj_g = document.getElementById("tableObj_General");
    var tableObj_Esp = document.getElementById("tableObj_Esp");
    var tablePon_General = document.getElementById("tablePon_General");
    var tablePon_Esp = document.getElementById("tablePon_Esp");
    if (ponderacion.style.display === "none") {
        ponderacion.style.display = "block";
        objetivo.style.display = "none";
        tablaObj_g.style.display = "none";
        tableObj_Esp.style.display = "none";
        tablePon_General.style.display = "none";
        tablePon_Esp.style.display = "none";
        document.getElementById("result_pond").selectedIndex = 0;
    }
}

function showPon() {
    getSelectValue = document.getElementById("result_pond").value;
    if (getSelectValue == "pon_gen") {
        document.getElementById("tablePon_General").style.display = "block";
        document.getElementById("tablePon_Esp").style.display = "none";
    }
    if (getSelectValue == "pon_esp") {
        document.getElementById("tablePon_General").style.display = "none";
        document.getElementById("tablePon_Esp").style.display = "block";

    }
}

function showPon_esp() {
    getSelectValue = document.getElementById("edat_pon").value;
    if (getSelectValue == "Alan Soto") {
        document.getElementById("espPon_a").style.display = "block";
        document.getElementById("espPon_n").style.display = "none";
        document.getElementById("espPon_p").style.display = "none";
        document.getElementById("espPon_y").style.display = "none";
    } else if (getSelectValue == "Nallely Quintana") {
        document.getElementById("espPon_a").style.display = "none";
        document.getElementById("espPon_n").style.display = "block";
        document.getElementById("espPon_p").style.display = "none";
        document.getElementById("espPon_y").style.display = "none";
    } else if (getSelectValue == "Paloma Razo") {
        document.getElementById("espPon_a").style.display = "none";
        document.getElementById("espPon_n").style.display = "none";
        document.getElementById("espPon_p").style.display = "block";
        document.getElementById("espPon_y").style.display = "none";
    } else {
        document.getElementById("espPon_a").style.display = "none";
        document.getElementById("espPon_n").style.display = "none";
        document.getElementById("espPon_p").style.display = "none";
        document.getElementById("espPon_y").style.display = "block";
    }
}


// SUMA TOTAL DE LOS PUNTOS ACOMULADOS/PONDERACION-GENERAL
function ptsPg() {
    var a = $('input[name=contactosPg]').val(),
        b = $('input[name=entrevistasPg]').val(),
        c = $('input[name=evaluacionesPg]').val(),
        d = $('input[name=ventasPg]').val(),
        e = $('input[name=induccionesPg]').val(),
        f = $('input[name=conexionesPg]').val();
    try {
        //Calculamos el número escrito:
        a = (isNaN(parseInt(a))) ? 0 : parseInt(a);
        b = (isNaN(parseInt(b))) ? 0 : parseInt(b);
        c = (isNaN(parseInt(c))) ? 0 : parseInt(c);
        d = (isNaN(parseInt(d))) ? 0 : parseInt(d);
        e = (isNaN(parseInt(e))) ? 0 : parseInt(e);
        f = (isNaN(parseInt(f))) ? 0 : parseInt(f);

        document.datosGenerales_pon.ptsPonEsp.value = a + b + c + d + e + f;
    }
    //Si se produce un error no hacemos nada
    catch (e) {}
}

// SUMA TOTAL DE LOS PUNTOS ACOMULADOS/PONDERACION-ESPECIFICA
function ptsPesp() {

    //ALAN
    var ponA_a = $('input[name=contactosA_ponE]').val(),
        ponA_b = $('input[name=entrevistasA_ponE]').val(),
        ponA_c = $('input[name=evaluacionesA_ponE]').val(),
        ponA_d = $('input[name=ventasA_ponE]').val(),
        ponA_e = $('input[name=induccionesA_ponE]').val(),
        ponA_f = $('input[name=conexionesA_ponE]').val();

    try {
        //Calculamos el número escrito:
        ponA_a = (isNaN(parseInt(ponA_a))) ? 0 : parseInt(ponA_a);
        ponA_b = (isNaN(parseInt(ponA_b))) ? 0 : parseInt(ponA_b);
        ponA_c = (isNaN(parseInt(ponA_c))) ? 0 : parseInt(ponA_c);
        ponA_d = (isNaN(parseInt(ponA_d))) ? 0 : parseInt(ponA_d);
        ponA_e = (isNaN(parseInt(ponA_e))) ? 0 : parseInt(ponA_e);
        ponA_f = (isNaN(parseInt(ponA_f))) ? 0 : parseInt(ponA_f);

        document.datosEspecificos_pon.ptsPonEsp_a.value = ponA_a + ponA_b + ponA_c + ponA_d + ponA_e + ponA_f;
    } catch (e) {}

    // NAYELLI
    var ponN_a = $('input[name=contactosN_ponE]').val(),
        ponN_b = $('input[name=entrevistasN_ponE]').val(),
        ponN_c = $('input[name=evaluacionesN_ponE]').val(),
        ponN_d = $('input[name=ventasN_ponE]').val(),
        ponN_e = $('input[name=induccionesN_ponE]').val(),
        ponN_f = $('input[name=conexionesN_ponE]').val();

    try {
        //Calculamos el número escrito:
        ponN_a = (isNaN(parseInt(ponN_a))) ? 0 : parseInt(ponN_a);
        ponN_b = (isNaN(parseInt(ponN_b))) ? 0 : parseInt(ponN_b);
        ponN_c = (isNaN(parseInt(ponN_c))) ? 0 : parseInt(ponN_c);
        ponN_d = (isNaN(parseInt(ponN_d))) ? 0 : parseInt(ponN_d);
        ponN_e = (isNaN(parseInt(ponN_e))) ? 0 : parseInt(ponN_e);
        ponN_f = (isNaN(parseInt(ponN_f))) ? 0 : parseInt(ponN_f);

        document.datosEspecificos_pon.ptsPonEsp_n.value = ponN_a + ponN_b + ponN_c + ponN_d + ponN_e + ponN_f;
    } catch (e) {}

    // PALOMA
    var ponP_a = $('input[name=contactosP_ponE]').val(),
        ponP_b = $('input[name=entrevistasP_ponE]').val(),
        ponP_c = $('input[name=evaluacionesP_ponE]').val(),
        ponP_d = $('input[name=ventasP_ponE]').val(),
        ponP_e = $('input[name=induccionesP_ponE]').val(),
        ponP_f = $('input[name=conexionesP_ponE]').val();

    try {
        //Calculamos el número escrito:
        ponP_a = (isNaN(parseInt(ponP_a))) ? 0 : parseInt(ponP_a);
        ponP_b = (isNaN(parseInt(ponP_b))) ? 0 : parseInt(ponP_b);
        ponP_c = (isNaN(parseInt(ponP_c))) ? 0 : parseInt(ponP_c);
        ponP_d = (isNaN(parseInt(ponP_d))) ? 0 : parseInt(ponP_d);
        ponP_e = (isNaN(parseInt(ponP_e))) ? 0 : parseInt(ponP_e);
        ponP_f = (isNaN(parseInt(ponP_f))) ? 0 : parseInt(ponP_f);

        document.datosEspecificos_pon.ptsPonEsp_p.value = ponP_a + ponP_b + ponP_c + ponP_d + ponP_e + ponP_f;
    } catch (e) {}

    // YAZMIN 
    var ponY_a = $('input[name=contactosY_ponE]').val(),
        ponY_b = $('input[name=entrevistasY_ponE]').val(),
        ponY_c = $('input[name=evaluacionesY_ponE]').val(),
        ponY_d = $('input[name=ventasY_ponE]').val(),
        ponY_e = $('input[name=induccionesY_ponE]').val(),
        ponY_f = $('input[name=conexionesY_ponE]').val();

    try {
        //Calculamos el número escrito:
        ponY_a = (isNaN(parseInt(ponY_a))) ? 0 : parseInt(ponY_a);
        ponY_b = (isNaN(parseInt(ponY_b))) ? 0 : parseInt(ponY_b);
        ponY_c = (isNaN(parseInt(ponY_c))) ? 0 : parseInt(ponY_c);
        ponY_d = (isNaN(parseInt(ponY_d))) ? 0 : parseInt(ponY_d);
        ponY_e = (isNaN(parseInt(ponY_e))) ? 0 : parseInt(ponY_e);
        ponY_f = (isNaN(parseInt(ponY_f))) ? 0 : parseInt(ponY_f);

        document.datosEspecificos_pon.ptsPonEsp_y.value = ponY_a + ponY_b + ponY_c + ponY_d + ponY_e + ponY_f;
    } catch (e) {}
}

// SOLO ADMITE NÚMEROS 
function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode;
    return ((key >= 48 && key <= 57) || (key == 8))
}

// FUNCION QUE NO PERMITE 0 AL INICIO DE CADA INPUT 
function pierdeFoco(e) {
    var valor = e.value.replace(/^0*/, '');
    e.value = valor;
}