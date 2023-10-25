<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Reporte;
use Spatie\SimpleExcel\SimpleExcelWriter;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use Doctrine\DBAL\DriverManager;



class reporteController extends Controller
{      
      


    public function Reporte():View {

        return view('reporte');
      }

    
    
    public function store(Request $request){

        $reporte = new Reporte();

        $reporte->nombre = $request->nombre;
        $reporte->filas = $request->filas;
        $NomReporte = $reporte->nombre;
        $NumFilas   = $reporte->filas;
          
        $border = new Border(
            new BorderPart(Border::BOTTOM, Color::DARK_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::TOP, Color::LIGHT_BLUE, Border::WIDTH_THIN, Border::STYLE_SOLID)
        );
        
        $border2 = new Border(
            new BorderPart(Border::BOTTOM, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::LEFT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::RIGHT, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID),
            new BorderPart(Border::TOP, Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
        );

    $Style2 = (new Style())
    ->setFontBold()
    ->setFontSize(10)
    ->setFontColor(Color::WHITE)
    ->setBackgroundColor(Color::BLUE)
    ->setCellAlignment(CellAlignment::CENTER)
    ->setBorder($border);


    $Style = (new Style())
    ->setFontBold()
    ->setFontSize(10)
    ->setFontColor(Color::BLACK)
    ->setShouldWrapText(true)
    ->setBackgroundColor(Color::WHITE)
    ->setCellAlignment(CellAlignment::CENTER)
    ->setBorder($border2);

   

$Style3 = (new Style())
    ->setFontBold()
    ->setShouldWrapText(true)

    ->setFontColor(Color::WHITE)
    ->setCellAlignment(CellAlignment::CENTER)
    ->setBackgroundColor(Color::DARK_BLUE)
    ->setBorder($border2);
    $connectionParams = [
        'dbname' => 'reportes_db',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = DriverManager::getConnection($connectionParams);
    $queryBuilder = $conn->createQueryBuilder();
    $queryBuilder
        ->select(['ciudad', 'COUNT(*) AS cantidad_personas'])
        ->from('personas')
        ->groupBy('ciudad')
        ->setMaxResults($NumFilas);
    $stmt = $queryBuilder->execute();
    $results = $stmt->fetchAll();
    $horaActual = date('H:i:s');
    $row2 = Row::fromValues(['La hora es:' . $horaActual]);
    $row2->setHeight(15.0);
    $row2->setStyle($Style3);
    
    
    $row3 = Row::fromValues([$NumFilas . ' REGISTROS']);
    $row3->setHeight(30.0);
    $row3->setStyle($Style3);           

      if (pathinfo($NomReporte, PATHINFO_EXTENSION) !== 'xlsx') {
          $NomReporte .= '.xlsx';
      }
      
      $pathToXlsx = $NomReporte;

      $writer = SimpleExcelWriter::create($pathToXlsx, configureWriter: function ($writer) {
        $options = $writer->getOptions();
        $options->DEFAULT_COLUMN_WIDTH = 25;
        $options->DEFAULT_ROW_HEIGHT = 20;
       
    })
              ->addrow($row2)
              ->addRow($row3)
              ->addHeader(['nombre', 'ciudad'])
              ->addRows($results,$Style2);
              
            
       $writer->close(); 

            
         return response()->download(public_path($pathToXlsx));



      }

    

}











