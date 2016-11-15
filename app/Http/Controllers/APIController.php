<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Space;
use App\Item;
use App\Estimation;
use App\EstimationSpace;
use App\EstimationItem;
use TCPDF;

class APIController extends Controller {

  public function __construct()
  {
    view()->share('type', 'space');
  }

	public function space()
	{
    $spaces = Space::orderBy('name', 'ASC')->get();
    return response()->json(array('data' => $spaces));
	}

  public function item()
  {
    $items = Item::orderBy('name', 'ASC')->get();
    return response()->json(array('data' => $items));
  }

  public function getEstimation($estimation)
  {
    foreach($estimation->spaces as $space) {
      $space->items;
    }
    return response()->json(array('estimation' => $estimation));
  }

  public function saveEstimation()
  {
    $spaces = Input::get('spaces');
    $estimation = new Estimation();
    $result = $estimation->save();
    if ($result) {
      foreach ($spaces as $space) {
          $est_space = new EstimationSpace();
          $est_space->estimation_id = $estimation->id;
          $est_space->name = $space['name'];
          $est_space->size_x = $space['size_x'];
          $est_space->size_y = $space['size_y'];
          $est_space->save();
          foreach ($space['items'] as $item) {
            $est_item = new EstimationItem();
            $est_item->space_id = $est_space->id;
            if (isset($item['obj'])) {
              $est_item->name = $item['obj']['name'];
              $est_item->type = $item['obj']['type'];
              $est_item->cost = $item['obj']['cost'];
              $est_item->price = $item['obj']['price'];
            }
            $est_item->save();
          }
      }
    }
    return response()->json(array('estimation_id' => $estimation->id));
  }

  public function updateEstimation($estimation)
  {
    $result = $estimation->update(Input::only(['customer_name', 'customer_address', 'customer_email', 'customer_phone', 'cc_email1', 'cc_email2', 'cc_email3']));


    // create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Capitol Wrecker');
		$pdf->SetTitle('Permits');
		$pdf->SetSubject('Vehicles Permits');
		$pdf->SetKeywords('Vehicles');

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set header and footer fonts
		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, 10);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

    $pdf->AddPage('P', 'LETTER');
		$pdf->SetFont('times', '', 25);
    $pdf->SetXY(150, 12);
    $pdf->MultiCell(40, 12, 'Invoice #'.$estimation->id , 0, 'C', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    // Customer Details
    $pdf->Rect(25, 20, 70, 35);
    $pdf->SetXY(30, 20);
    $pdf->MultiCell(60, 6, 'Customer Information ', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    $pdf->SetXY(30, 27);
    $pdf->MultiCell(30, 3, 'Name: ', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
    $pdf->SetXY(50, 27);
    $pdf->MultiCell(30, 4, $estimation->customer_name, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    $pdf->SetXY(30, 32);
    $pdf->MultiCell(35, 3, 'Address: ', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
    $pdf->SetXY(50, 32);
    $pdf->MultiCell(35, 12, $estimation->customer_address, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    $pdf->SetXY(30, 45);
    $pdf->MultiCell(30, 3, 'Phone #: ', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
    $pdf->SetXY(50, 45);
    $pdf->MultiCell(30, 4, $estimation->customer_phone, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    $pdf->SetXY(30, 50);
    $pdf->MultiCell(30, 3, 'Email: ', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
    $pdf->SetXY(50, 50);
    $pdf->MultiCell(30, 4, $estimation->customer_email, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

    $pdf->Rect(25, 60, 170, 150);
    $y = 65;
    $total_price = 0;
    foreach($estimation->spaces as $space) {
      $pdf->SetXY(30, $y);
      $pdf->MultiCell(30, 6, $space->name, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
      $pdf->SetXY(140, $y);
      $pdf->MultiCell(20, 6, $space->size_x . ' Ft', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
      $pdf->SetXY(160, $y);
      $pdf->MultiCell(20, 6, $space->size_y . ' Ft', 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
      $y+=5;

      foreach($space->items as $item) {
        $pdf->SetXY(40, $y);
        $pdf->MultiCell(30, 3, $item->name, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
        $pdf->SetXY(140, $y);
        $pdf->MultiCell(20, 3, '$'.$item->price, 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
        $pdf->SetXY(160, $y);
        $pdf->MultiCell(20, 3, '$'.($item->price * $space->size_x * $space->size_y), 0, 'L', 0, 1, '', '', true, 0, false, true, 5, 'T', true);
        $total_price += $item->price * $space->size_x * $space->size_y;
        $y+=5;
      }
      $y+=4;
    }

    $pdf->SetXY(150, 220);
    $pdf->MultiCell(45, 12, 'Total Price: $'.$total_price, 0, 'R', 0, 1, '', '', true, 0, false, true, 5, 'T', true);

		//Close and output PDF document
    $filename = base_path().'/public/invoices/invoice-'.$estimation->id.'.pdf';
		$pdf->Output($filename, 'F');
    return response()->json(array('result' => $result, 'path' => url('/invoices/invoice-'.$estimation->id.'.pdf')));
  }

}
