<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {		
      public function Header(){
        
      }
      public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
      }
}
