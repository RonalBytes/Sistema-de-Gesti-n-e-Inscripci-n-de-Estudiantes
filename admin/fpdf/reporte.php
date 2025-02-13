<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../bd.php';//llamamos a la conexion BD

      $consulta_info = $conexion->query(" select * from tbl_registro ");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch(PDO::FETCH_OBJ);
      $this->Image('logotipo.png', 9, 5, 28); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      
      $this->Cell(85, 0, utf8_decode('Institucion Ambiente'), 0, 1, 'C', 0);
      $this->Cell(175, 8, utf8_decode('RUC:245789874521'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Cell(175, 0, utf8_decode('Direc: Calle los laureles N° 987,'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Cell(175, 6, utf8_decode('San isidro Lima - Perú'), 0, 1, 'C', 0);
      $this->Cell(175, 0, utf8_decode('Correo: byronaldoelias@gmail.com'), 0, 1, 'C', 0);
      
      setlocale(LC_TIME, 'es_Es');
      $hoy = date('Y-m-d');
      $fecha_letras = strftime("%d de %B del %Y", strtotime($hoy));
      

      $this->Cell(348, 0, utf8_decode($fecha_letras), 0, 0, 'C');
 // pie de pagina(fecha de pagina)
      
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->SetY($this->GetY() - 19);
      $this->SetFillColor(159, 170, 250 );
      $this->SetTextColor(23, 32, 42); //colorTexto
      $this->SetDrawColor(23, 32, 42); //colorBorde
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(160);
      $this->Cell(30, 6, utf8_decode('Tabla de Inscripción'), 0, 1, 'C', 1);
      $this->Cell(160);
      $this->Cell(30, 6, utf8_decode('RN'), 0, 1, 'C', 1);
      
      
      

      /* TELEFONO adicional por si piden */
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode(" "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO  adicional por si piden*/
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO  adicional por si piden*/
      $this->Cell(110);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(192, 57, 43);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'I', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE INSCRIPCIÓN "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(156, 148, 147      ); //colorFondo
      $this->SetTextColor(23, 32, 42); //colorTexto
      $this->SetDrawColor(23, 32, 42); //colorBorde
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(6, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Codigo'), 1, 0, 'C', 1);
      $this->Cell(41, 10, utf8_decode('Curso Inscrito'), 1, 0, 'C', 1);
      $this->Cell(19, 10, utf8_decode('Nivel'), 1, 0, 'C', 1);
      $this->Cell(15, 10, utf8_decode('Turno'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Modalidad'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Inicio'), 1, 0, 'C', 1);
      $this->Cell(15, 10, utf8_decode('Billetera'), 1, 0, 'C', 1);
      $this->Cell(14, 10, utf8_decode('Pago'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../bd.php';

/* CONSULTA INFORMACION DEL HOSPEDAJE */


$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFillColor(156, 148, 147 );
$pdf->SetFont('Arial', '', 8);
$pdf->SetDrawColor(23, 32, 42);
 //colorBorde

 $consulta_reporte_inscripcion = $conexion->query("
 SELECT 
     tbl_estudiantes.Codigo, 
     tbl_modalidad.modalidad, 
     tbl_nivel.tipo, 
     tbl_pagos.nombre, 
     GROUP_CONCAT(tbl_servicios.Codigo SEPARATOR ' & ') AS 'cursos', 
     tbl_turno.tipo AS 'turnos', 
     tbl_registro.monto, 
     tbl_registro.Fecha_actual,
     tbl_servicios.fecha_curso
 FROM tbl_registro
 INNER JOIN tbl_estudiantes ON tbl_registro.idestudiante = tbl_estudiantes.ID
 INNER JOIN tbl_modalidad ON tbl_registro.idmodalidad = tbl_modalidad.id
 INNER JOIN tbl_nivel ON tbl_registro.idnivel = tbl_nivel.id
 INNER JOIN tbl_pagos ON tbl_registro.idpago = tbl_pagos.id
 INNER JOIN tbl_servicios ON tbl_registro.idcurso = tbl_servicios.ID
 INNER JOIN tbl_turno ON tbl_registro.idturno = tbl_turno.id
 GROUP BY tbl_estudiantes.ID
");


while ($datos_reporte = $consulta_reporte_inscripcion->fetch(PDO::FETCH_ASSOC)) {
   $i = $i + 1;
 $pdf->Cell(6, 10, utf8_decode($i), 1, 0, 'C', 0);
 $pdf->Cell(20, 10, utf8_decode($datos_reporte['Codigo']), 1, 0, 'C', 0);
 $pdf->Cell(41, 10, utf8_decode($datos_reporte['cursos']), 1, 0, 'C', 0);
 $pdf->Cell(19, 10, utf8_decode($datos_reporte['tipo']), 1, 0, 'C', 0);
 $pdf->Cell(15, 10, utf8_decode($datos_reporte['turnos']), 1, 0, 'C', 0);
 $pdf->Cell(20, 10, utf8_decode($datos_reporte['modalidad']), 1, 0, 'C', 0);
 $pdf->Cell(20, 10, utf8_decode($datos_reporte['Fecha_actual']), 1, 0, 'C', 0);
 $pdf->Cell(20, 10, utf8_decode($datos_reporte['fecha_curso']), 1, 0, 'C', 0);
 $pdf->Cell(15, 10, utf8_decode($datos_reporte['nombre']), 1, 0, 'C', 0);
 $pdf->Cell(14, 10, utf8_decode('S/. ' . $datos_reporte['monto']), 1, 1, 'C', 0);
}

$pdf->Output('IEA.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
