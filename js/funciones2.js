  function agregaform(reg){
 
    r = reg.split('||');

    $('#f_contacto').val(r[3]);
    $('#f_entrevista').val(r[9]);
    $('#f_induccion').val(r[40]);
    $('#f_conexion').val(r[42]);

  }
    
    function reload(segs) {
        setTimeout(function() {
            location.reload();
        }, parseInt(segs) * 1000);
    }