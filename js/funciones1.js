    function agregaform1(reg) {

        r = reg.split('||');

        $('#idpersona').val(r[0]);
        $('#edatu').val(r[1]);
        $('#nombreu').val(r[2]);
        $('#gerenteu').val(r[3]);
        $('#fecha_induccionu').val(r[5]);
        $('#fecha_conexionu').val(r[6]);
        $('#fuenteu').val(r[7]);
        $('#fec_real').val(r[8]);
        $('#fech_con').val(r[9]);
        $('#esta').val(r[10]);
    }

    function agregaform2(reg) {

        r = reg.split('||');

        $('#f_contacto').val(d[3]);
        $('#f_entrevista').val(d[9]);
        $('#f_induccion').val(d[40]);
        $('#f_conexion').val(d[42]);

    }


    function actualizafcon() {

        id = $('#idpersona').val();
        fec_real = $('#fec_real').val();
        fech_con = $('#fech_con').val();
        esta = $('#esta').val();


        cadena = "id=" + id +
            "&fec_real=" + fec_real +
            "&fech_con=" + fech_con +
            "&esta=" + esta;



        $.ajax({
            type: "POST",
            url: "php/actualizafcon.php",
            data: cadena,
            success: function(r) {

                if (r == 1) {
                    $('#tabla').reload('componentes/tablacap.php');
                    alertify.success("Actualizado con Exito :)");
                } else {
                    alertify.error("Fallo el servidor :(");
                    alertify.error(fecha_conexion);
                }

            }
        })
    }

    function reload(segs) {
        setTimeout(function() {
            location.reload();
        }, parseInt(segs) * 1000);
    }