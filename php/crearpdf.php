<?php

  include 'pdf.php';
  require_once "conexion.php";
  $conexion = conexion();

  $id = $_POST['id'];

  $sql = "Select * from llenado_formulario where id ='$id' ";
  $result = $conexion->query($sql);



  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  while($row = $result->fetch_assoc()){
//Conteo de factores vitales
if(empty($row['patron'])){
    $cont = '0';
}      
else{
    $array = explode(",", $row['patron']);
    $cont = count($array);
}

      
 //ESPACIO EN BLANCO FIJO
  $pdf->Cell(180, 10,'',0,1,'C');
     
  $pdf->Image('../imagenes/imagen.jpg',13,8,-300);
  //NOMBRE EDAT Y FECHA RECUPERADOS
  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(50, 5, 'Fuente de Reclutamiento: ',0,0,'R');
  $pdf->Cell(50, 4, utf8_decode($row['fuente']),0,1,'C',1);
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->Cell(50, 5, 'Agente que refiere: ',0,0,'R');
  $pdf->Cell(50, 4, utf8_decode($row['referido']),0,0,'C',1);
  $pdf->Cell(55, 5, 'Fecha: ',0,0,'R');
  $pdf->Cell(25, 4, utf8_decode($row['fechareg']),0,1,'C',1);
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->Cell(50, 5, 'EDAT: ',0,0,'R');
  $pdf->Cell(50, 4, utf8_decode($row['edat']),0,1,'C',1);
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->Cell(50, 5, 'GDD: ',0,0,'R');
  if($row['gerente'] == "Danielan"){
      $pdf->Cell(50, 4, utf8_decode("Daniela"),0,1,'C',1);
  }else if($row['gerente'] == "Omarn"){
      $pdf->Cell(50, 4, utf8_decode("Omarn"),0,1,'C',1);
  }else if($row['gerente'] == "Roberton"){
      $pdf->Cell(50, 4, utf8_decode("Roberto"),0,1,'C',1);
  }else if($row['gerente'] == "Martin"){
      $pdf->Cell(50, 4, utf8_decode("Martin"),0,1,'C',1);
  }else if($row['gerente'] == "Nancyn"){
      $pdf->Cell(50, 4, utf8_decode("Nancy"),0,1,'C',1);
  }
  

  //ESPACIO EN BLANCO FIJO
  $pdf->Cell(180, 8, '',0,1,'C');

  //SUBTITULO FIJO
  $pdf->SetFillColor(0, 102, 255);
  //$pdf->Cell(90, 4, '',0,0,'C');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(180, 3, 'Datos Generales del Candidato',0,1,'C',1);

  //ESPACIO EN BLANCO
  $pdf->Cell(180, 1, '',0,1,'C');

  //DATOS GENERALES DEL CANDIDATO
  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial', 'B', 7);
  $pdf->Cell(99, 3, 'Nombre',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, 'Ingreso',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, 'Edad',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(25, 3, 'Estado Civil',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, 'Dependientes',0,1,'C');
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(99, 3, utf8_decode($row['nombre']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, utf8_decode("$".$row['ingreso']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, utf8_decode($row['edad']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(25, 3, utf8_decode($row['edo_civil']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(18, 3, utf8_decode($row['dependientes']),0,1,'C',1);

  $pdf->Cell(180, 1, '',0,1,'C');

  $pdf->Cell(59, 3, 'Delegacion/Municipio',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(60, 3, 'Escolaridad',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(60, 3, 'Especialidad',0,0,'C');
  $pdf->Cell(0.5, 3, '',0,1,'C');
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(59, 3, utf8_decode($row['direccion']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(60, 3, utf8_decode($row['escolaridad']),0,0,'C',1);
  $pdf->Cell(0.5, 3, '',0,0,'C');
  $pdf->Cell(60, 3, utf8_decode($row['carrera']),0,1,'C',1);

  $pdf->Cell(180, 3, '',0,1,'C');
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(70, 3, 'PSP',0,0,'C',1);
  $pdf->Cell(40, 3, '',0,0,'C');
  $pdf->Cell(70, 3, 'Factores Know-Out',0,1,'C',1);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(35, 3, 'Rendimiento de Ventas',0,0,'R');
      $pdf->SetFillColor(206, 206, 206);
  $pdf->Cell(35, 3, utf8_decode($row['rendimiento_venta']),0,0,'C',1);
  $pdf->Cell(40, 3, '',0,0,'C');
$pdf->SetFillColor(232,232,232);
  $pdf->Cell(10, 3, utf8_decode($row['patron']),0,0,'C',1);
  $pdf->SetFillColor(206, 206, 206);
  $pdf->Cell(60, 3, '1 Factor = Preocupante',0,1,'L',1);
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->Cell(35, 3, 'Precision',0,0,'R');
  $pdf->Cell(35, 3, utf8_decode($row['precision_venta']),0,0,'C',1);
  $pdf->Cell(40, 3, '',0,0,'C');
$pdf->SetFillColor(232,232,232);
  $pdf->Cell(10, 3, '',0,0,'C',1);
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(60, 3, '2 Factores = Menos del 50% de probabilidad de exito',0,1,'L',1);
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->Cell(35, 3, 'Estilo de Venta',0,0,'R');
  $pdf->SetFillColor(206, 206, 206);
  $pdf->Cell(35, 3, utf8_decode($row['estilo_venta']),0,0,'C',1);
  $pdf->Cell(40, 3, '',0,0,'C');
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(10, 3, '',0,0,'C',1);
  $pdf->SetFillColor(206, 206, 206);
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(60, 3, '3 Factores = No continuar',0,1,'L',1);
  $pdf->Cell(180, 3, '',0,1,'C');

  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(42, 3, 'FACTORES VITALES',0,0,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(50, 3, '',0,0,'C',1);
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(35, 3, 'POTENCIAL DE EXITO',0,0,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(17, 3, 'PUNTOS',0,0,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(17, 3, 'POTENCIAL',0,1,'C',1);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Caracter e Integridad',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['caracter']),0,0,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(50, 3, '',0,0,'C',1);    
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(10, 3, 'SUMA:',0,0,'L',1);
  $pdf->Cell(25, 3, utf8_decode($row['sumapotencial']." - ". $row['mensajepotencial']),0,0,'R',1);

  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(17, 3, '100 O MAS',0,0,'C',1);
      
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);    
  $pdf->Cell(17, 3, 'SUPERIOR',0,1,'C',1);
      
  
      
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Orientacion al logro',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['logro']),0,0,'C',1);
      
  $pdf->Cell(85, 3, '',0,0,'C'); 
  $pdf->SetFillColor(255, 255, 255);
  
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(243, 250, 153);    
  $pdf->Cell(17, 3, '88-99',0,0,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  $pdf->SetFillColor(243, 250, 153);    
  $pdf->Cell(17, 3, 'ACEPTABLE',0,1,'C',1);
      
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Sentido Comun',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['sentido']),0,0,'C',1);
  //Espacio en blanco 
  $pdf->Cell(85, 3, '',0,0,'C'); 
  //Espacio peque単o en blanco 
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  //Color y celda
  $pdf->SetFillColor(250, 162, 153);  
  $pdf->Cell(17, 3, '65-79',0,0,'C',1);   
  //Espacio peque単o en blanco 
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(.5, 3, '',0,0,'C',1);
  //Color y celda
  $pdf->SetFillColor(250, 162, 153);   
  $pdf->Cell(17, 3, 'Dudoso',0,1,'C',1);  

  $pdf->Cell(180, 0.4, '',0,1,'C');    
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Alto nivel de energia',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['energia']),0,1,'C',1);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->Cell(180, 0.4, '',0,1,'C');
      
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Motivacion por el dinero',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['motivacion']),0,1,'C',1);
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Perseverancia',0,0,'R',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(15, 3, utf8_decode($row['perseverancia']),0,1,'C',1);
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->Cell(180, 0.4, '',0,1,'C');
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(18, 3, '',0,0,'C');
  $pdf->Cell(26, 3, 'Total',0,0,'C',1);
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->SetFillColor(206, 206, 206);
  $pdf->Cell(15, 3, utf8_decode($row['puntos']),0,1,'C',1);
  $pdf->Cell(180, 0.4, '',0,1,'C');

  $pdf->Cell(180, 3, '',0,1,'C');
  //ESPACIO EN BLANCO
  $pdf->Cell(180, 1, '',0,1,'C');

    //SUBTITULO FIJO
  $pdf->SetFillColor(0, 102, 255);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(180, 3, 'Competencias',0,1,'C',1);

  //ESPACIO EN BLANCO
  $pdf->Cell(180, 4, '',0,1,'C');

  //NOMBRE EDAT Y FECHA FIJOS
  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(20, 3, 'Nombre: ',0,0,'C');
  $pdf->Cell(100, 3, '',0,0,'C',1);
  $pdf->Cell(30, 3, 'Fecha: ',0,0,'R');
  $pdf->Cell(30, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->Cell(180, 1, '',0,1,'C');
  $pdf->Cell(180, 3, '',0,1,'C');
  $pdf->Cell(133,1,'',0,0,'C');
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->SetFillColor(245, 51, 32);
  $pdf->Cell(15, 3, 'BAJA',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(249, 238, 71);
  $pdf->Cell(15, 3, 'PRESENTE',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(113, 244, 71);
  $pdf->Cell(15, 3, 'ALTA',0,1,'C',1);
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //ORIENTACION
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'ORIENTACION AL LOGRO',0,0,'L');
  $pdf->Cell(45, 1, 'Cuales son tus metas en este momento?',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'Menciona 3 fortalezas personales que te ayuden a cumplir tus metas',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //INTEGRIDAD
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'CARACTER E INTEGRIDAD',0,0,'L');
  $pdf->Cell(45, 1, 'Menciona 3 valores que rijan tu vida',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'Como generas confianza en las personas a tu alrededor',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //ENERGIA
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'ALTO NIVEL DE ENERGIA',0,0,'L');
  $pdf->Cell(45, 1, 'Que estrategias utiliza para planificar sus actividades de un dia laboral',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'En tu empleo anterior Como planeabas tus actividades',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //MOTIVACION
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'MOTIVACION POR EL DINERO',0,0,'L');
  $pdf->Cell(45, 1, 'Tiene deseos de tener lo que las personas exitosas tienen',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'Cuando es exitosa una persona',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //PERSEVERANCIA
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'PERSEVERANCIA',0,0,'L');
  $pdf->Cell(45, 1, 'Como enfretaste los cambios repentinos en tu empleo anterior',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'Cual ha sido el error mas grande que tuviste y como lo manejaste',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);

  //SENTIDO
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(180, 0.8, '',0,1,'C');
  $pdf->Cell(35, 1, 'SENTIDO COMUN',0,0,'L');
  $pdf->Cell(45, 1, 'Porque te interesa trabajar en el sector financiero',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(15, 3, '',0,1,'C',1);
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(35, 1, '',0,1,'C');
  $pdf->Cell(35, 6, '',0,0,'C');
  $pdf->Cell(45, 1, 'La eficacia de la venta depende del conocimiento del producto',0,0,'L');
  $pdf->Cell(53, 1, '',0,0,'C');
  $pdf->SetFillColor(250, 162, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->SetFillColor(243, 250, 153);
  $pdf->Cell(15, 3, '',0,0,'C',1);
  $pdf->SetFillColor(196, 250, 153);
  $pdf->Cell(1, 1, '',0,0,'C');
  $pdf->Cell(15, 3, '',0,1,'C',1);

  //ESPACIO GRIS
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(180, 0.8, '',0,1,'C',1);
  $pdf->Cell(180, 9, '',0,1,'C');

  //ACEPTADO/RECHAZADO/COMENTARIOS/KNOCKOUT
  $pdf->SetFont('Arial', 'B', 6);

  $pdf->Cell(30, 4, 'Colchon Economico',0,0,'R');
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(30, 3, '',0,0,'C',1);
  $pdf->Cell(30, 3, '',0,0,'C');
  $pdf->SetFillColor(0, 102, 255);
  $pdf->Cell(80, 3, 'COMENTARIOS',0,1,'C',1);
  $pdf->Cell(180, 0.5, '',0,1,'C');
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(30, 4, 'Knockout',0,0,'R');
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(30, 3, '',0,0,'C',1);
  $pdf->Cell(30, 3, '',0,0,'C');
  $pdf->Cell(80, 3, '',0,1,'C',1);
  $pdf->Cell(180, 0.5, '',0,1,'C');
  $pdf->Cell(30, 4, 'Medio de Transporte',0,0,'R');
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(30, 3, '',0,0,'C',1);
  $pdf->Cell(30, 3, '',0,0,'C');
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(80, 3, '',0,1,'C',1);
  $pdf->Cell(180, 0.5, '',0,1,'C');
  $pdf->Cell(30, 4, 'Calificacion',0,0,'R');
  $pdf->Cell(1, 3, '',0,0,'C');
  $pdf->Cell(30, 3, '',0,0,'C',1);
  $pdf->Cell(30, 3, '',0,0,'C');
  $pdf->Cell(80, 3, '',0,1,'C',1);

  //FIRMAS
  $pdf->Cell(180, 9, '',0,1,'C');

  $pdf->Cell(150, 3, '',0,0,'C',1);
  $pdf->Cell(20, 4, 'Aceptado',0,0,'R');
  $pdf->Cell(10, 3, '',0,1,'C',1);
  $pdf->Cell(180, 0.4 , '',0,1,'C');
  $pdf->Cell(30, 4, 'Reclutamiento',0,0,'C');
  $pdf->Cell(20, 4, '',0,0,'C');
  $pdf->Cell(30, 4, 'Gerente',0,0,'C');
  $pdf->Cell(20, 4, '',0,0,'C');
  $pdf->Cell(30, 4, 'DA',0,0,'C');
  $pdf->Cell(40, 4, 'Rechazado',0,0,'R');
  $pdf->Cell(10, 3, '',0,1,'C',1);

  //ESPACIO EN BLANCO
  $pdf->Cell(180, 4, '',0,1,'C');

  //SUBTITULO FIJO
  $pdf->SetFillColor(255,165,0);
  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(180, 4, '',0,1,'C',1);
  }
  $pdf->Output();
