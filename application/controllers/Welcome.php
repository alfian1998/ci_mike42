<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->library("EscPos.php");

		try {
		  	$connector = new Escpos\PrintConnectors\WindowsPrintConnector("smb://DESKTOP-MG3459I/POS-58");
			   
			/* Print a "Hello world" receipt" */
			$type = Escpos\Printer::BARCODE_CODE39;
			//
			$printer = new Escpos\Printer($connector);
			$printer -> text("Hello World!\n");
			$printer -> barcode(123456, $type);
			$printer -> pulse(0, 120, 240);

			/* Close printer */
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
	}
}
