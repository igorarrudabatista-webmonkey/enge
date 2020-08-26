<?php

namespace Nornas;

require_once(SITE_PATH . "/vendor/tcpdf/tcpdf.php");

class PDF extends \TCPDF{
	protected $company = null;

	public function __construct ($company)
	{
		$this->company = $company;

		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}

	public function Header() {
        $logo = STATIC_URL . 'images/logo.png';

        $html = <<<EOD
<img style="" src="$logo" width="180px">
EOD;
		$this->writeHTMLCell($w=0, $h=0, $x=15, $y=13, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
		
        $html = <<<EOD
<p style="font-size: 12px;">CNPJ 30.084.879/0001-68</p>
EOD;

		$this->writeHTMLCell($w=0, $h=0, $x=70, $y=14, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

        $html = <<<EOD
<p style="font-size: 12px;"><a href="www.engeagrobrasil.com.br">www.engeagrobrasil.com.br</a></p>
EOD;

		$this->writeHTMLCell($w=0, $h=0, $x=70, $y=18, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

        $html = <<<EOD
<p style="font-size: 12px;">(65) 98474-1935</p>
EOD;

		$this->writeHTMLCell($w=0, $h=0, $x=70, $y=22, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

        $html = <<<EOD
<p style="font-size: 12px;">(65) 99801-6781</p>
EOD;
        
		$this->writeHTMLCell($w=0, $h=0, $x=70, $y=26, $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
		
		$this->SetFont('helvetica', 'B', 15);
		
		$this->Write(0, 'Produtos ativos da empresa "' . $this->company["name"] . '"', '', 0, 'C', true, 0, false, false, 0);
		
		$this->SetFont('helvetica', '', 8);

		$tbl = <<<EOD
<table border="1" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <th>Etiqueta</th>
  <th>Título</th>
  <th>Descrição</th>
  <th>Grupo</th>
  <th>Modelo</th>
  <th>Situação</th>
 
  <th>Imagem</th>
 </tr>
</table>
EOD;

		$this->writeHTML($tbl, true, false, false, false, '');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}