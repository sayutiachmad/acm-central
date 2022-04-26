<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//call dom pdf external library from third party folder
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{

	public function generate($html, $filename='', $paper = 'A4', $orientation = 'portrait', $stream=TRUE){ 

          
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('defaultMediaType', 'all');
        $options->set('isFontSubsettingEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 1));
        } else {
            return $dompdf->output();
        }
    }
	

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
