<?php

  require 'fpdf/fpdf.php';

  class PDF extends FPDF{
    function Header(){
      $this->SetFont('Arial','B',13);
      $this->Cell(30);
      $this->Cell(150,10, 'Formato Evaluacion Entrevista',0,0,'R');

      $this->Ln(15);
    }
  }
  ?>
