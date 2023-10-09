<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['idpersonavitales'];
  $kopatronr = $_POST['kopatronr'];
 

  $sql="UPDATE llenado_formulario set falta_patron_exito='$kopatronr'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
<!-- Modal para Factores know-out-->
    <div class="modal fade" id="modalknowout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
          </div>
          <div class="modal-body">
             <center><label><strong><u>Factores Know-Out</u></strong></label></center>
             <br>
              <style>
                  #modalknowout td{
                      padding-left: 5px;
                      vertical-align: middle;
                  }
             #modalknowout .modal-body{
  height: 500px;
  width: 100%;
  overflow-y: auto;
}</style>
        <table class="table"  border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>CheckBox</th>
                    <th>Concepto</th>
                    <th>CheckBox</th>
                </tr>
            </thead>
            <tbody><tr>
            <td><label>Falta de patrón de exito </label> </td>
                 <td> <input type="checkbox" id="kopatron" onchange="contarcheckbox();"></td>
                <td><label>No posee seguros</label></td>
                 <td> <input type="checkbox" id="koseguros" onchange="contarcheckbox();"></td>
                
            </tr>
            <tr>
                <td><label>Bajo nivel de energia</label></td>
                <td><input type="checkbox" id="koenergia" onchange="contarcheckbox();"></td>
                <td><label>Recientemente divorciado</label></td>
                 <td> <input type="checkbox" id="kodivorciado" onchange="contarcheckbox();"></td>
            </tr>
            <tr>
                <td><label>Malos habitos de vida</label></td>
                <td><input type="checkbox" id="kohabitos" onchange="contarcheckbox();"></td>
                 <td><label>Cambia de trabajo con frecuencia (inestable)</label></td>
                 <td> <input type="checkbox" id="koinestable" onchange="contarcheckbox();"></td>
            </tr>
            <tr>
                <td><label>Mercado natural débil - falta de contactos</label></td>
                <td><input type="checkbox" id="komercado" onchange="contarcheckbox();"></td>
                <td><label>Considera las ventas como un retroceso</label></td>
                 <td> <input type="checkbox" id="koretroceso" onchange="contarcheckbox();"></td>
            </tr>
            <tr>
                <td><label>Falta de movilidad social</label></td>
                <td><input type="checkbox" id="komovilidad" onchange="contarcheckbox();"></td>
                <td><label>En zona confort</label></td>
                 <td> <input type="checkbox" id="koconfort" onchange="contarcheckbox();"></td>
            </tr>
            <tr>
                <td><label>Muchas deudas / quiebra reciente</label></td>
                <td><input type="checkbox" id="kodeudas" onchange="contarcheckbox();"></td>
                <td><label>Necesita trabajo desesperada e inmediatamente</label></td>
                 <td> <input type="checkbox" id="kodesesperado" onchange="contarcheckbox();"></td>
            </tr>
            <tr>
                <td><label>Culpa a los demas por su falta de exito</label></td>
                <td><input type="checkbox" id="koculpa" onchange="contarcheckbox();"></td>
                
                <input id="idpersonaknowout" value="<?php echo $id ?>" tyoe="text">
                <input id="kopatronr" value="" name="" type="text">
                <input id="kosegurosr" value="" name="" type="text">
                <input id="koenergiar" value="" name="" type="text">
                <input id="kodivorciador" value="" name="" type="text">
                <input id="kohabitosr" value="" name="" type="text">
                <input id="koinestabler" value="" name="" type="text">
                <input id="komercador" value="" name="" type="text">
                <input id="koretrocesor" value="" name="" type="text">
                <input id="komovilidadr" value="" name="" type="text">
                <input id="koconfortr" value="" name="" type="text">
                <input id="kodeudasr" value="" name="" type="text">
                <input id="kodesesperador" value="" name="" type="text">
                <input id="koculpar" value="" name="" type="text">
                
            </tr>
           </tbody>
              </table>
              <script>
              //script para aparecer resultado en input
                function contarcheckbox(){
                    var cant = 0;
                   // alert(cant);
                    if (document.getElementById('kopatron').checked)
                    {
                        alert();
                        document.getElementById('kopatronr').value = "Si";
                                cant++;   
                    }
                    else{
                      document.getElementById('kopatronr').value = "No";  
                    }
                    if (document.getElementById('koenergia').checked)
                    {
                                cant++;  
                        document.getElementById('koenergiar').value = "Si";
                    }
                    else{
                      document.getElementById('koenergiar').value = "No";  
                    }
                    if (document.getElementById('kohabitos').checked)
                    {
                                cant++;  
                        document.getElementById('kohabitosr').value = "Si";
                    }
                    else{
                      document.getElementById('kohabitosr').value = "No";  
                    }
                    if (document.getElementById('komercado').checked)
                    {
                                cant++;  
                        document.getElementById('komercador').value = "Si";
                    }
                    else{
                      document.getElementById('komercador').value = "No";  
                    }
                    if (document.getElementById('komovilidad').checked)
                    {
                                cant++;  
                        document.getElementById('komovilidadr').value = "Si";
                    }
                    else{
                      document.getElementById('komovilidadr').value = "No";  
                    }
                    if (document.getElementById('kodeudas').checked)
                    {
                                cant++;  
                        document.getElementById('kodeudasr').value = "Si";
                    }
                    else{
                      document.getElementById('kodeudasr').value = "No";  
                    }
                    if (document.getElementById('koculpa').checked)
                    {
                                cant++;  
                        document.getElementById('koculpar').value = "Si";
                    }
                    else{
                      document.getElementById('koculpar').value = "No";  
                    }
                    if (document.getElementById('koseguros').checked)
                    {
                                cant++;  
                        document.getElementById('kosegurosr').value = "Si";
                    }
                    else{
                      document.getElementById('kosegurosr').value = "No";  
                    }
                    if (document.getElementById('kodivorciado').checked)
                    {
                                cant++;
                        document.getElementById('kodivorciador').value = "Si";
                    }
                    else{
                      document.getElementById('kodivorciador').value = "No";  
                    }
                    if (document.getElementById('koinestable').checked)
                    {
                                cant++;  
                        document.getElementById('koinestabler').value = "Si";
                    }
                    else{
                      document.getElementById('koinestabler').value = "No";  
                    }
                    if (document.getElementById('koretroceso').checked)
                    {
                                cant++;  
                        document.getElementById('koretrocesor').value = "Si";
                    }
                    else{
                      document.getElementById('koretrocesor').value = "No";  
                    }
                    if (document.getElementById('koconfort').checked)
                    {
                                cant++;  
                        document.getElementById('koconfortr').value = "Si";
                    }
                    else{
                      document.getElementById('koconfortr').value = "No";  
                    }
                    if (document.getElementById('kodesesperado').checked)
                    {
                                cant++;  
                        document.getElementById('kodesesperador').value = "Si";
                    }
                    else{
                      document.getElementById('kodesesperador').value = "No";  
                    }
                    if(cant==0){
                        document.getElementById("koresultado").value = "Aceptable";
                    }
                    if(cant==1){
                        document.getElementById("koresultado").value = "1 Factor = Preocupante";
                    }
                    if(cant==2){
                        document.getElementById("koresultado").value = ("2 Factores = Menos del 50% de \n probabilidad de exito");
                    }
                    if(cant >= 3){
                        document.getElementById("koresultado").value = "3 Factores = No continuar";
                    }
                   //este va a poner el mensaje.  
                  // document.getElementById("koresultado").value = cant;
              
                }
              </script>
             <center><label>Resultado Factores Know-Out</label>
            <input disabled placeholder="Aceptable" type="text" id="koresultado" style="height:50px" class="form-control input-sm">
              </center> 
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="knowout" data-dismiss="modal" data-toggle="modal">Actualizar y pasar a Previsibilidad de Éxito</button>
          </div>
        </div>
      </div>
    </div>   
</div> 