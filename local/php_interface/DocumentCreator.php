<?

class DocumetntCreater
{
    public static function createProxy(
        Bitrix\Sale\Order $order,
        $producer = array(
            'NAME' => 'ИП СЕРОВ С.И.',
            'LOCATION' => ' г. Москва, Рижская пл-дь, д.9, стр.2а.'
        )
    )
    {
// Include the main TCPDF library (search for installation path).

        $client = array(
            'NAME' => '',
            'PASSPORT_NUM' => '',
            'INN' => ''
        );
        $shipment = array(
            'INN' => '',
            'OGRN' => '',
            'JURADDR' => ''
        );
        $orderId = $order->getId();
        require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/TCPDF-master/tcpdf.php');


        $date = date('d:m:Y');

// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        /*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));*/
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

// set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $html = <<<EOD

<h1>Доверенность</h1>
<table>
<tbody>
<tr>
    <td>Я, </td><td>{$client['NAME']}</td>
</tr>
<tr>
    <td> Паспорт</td><td>{$client['PASSPORT_NUM']}</td>
</tr>
<tr>
    <td> ИНН</td><td>{$client['INN']}</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
    <td>доверяю получать товар</td><td></td>
</tr>
<tr>
    <td> у поставщика</td><td>{$producer['NAME']}</td>
</tr>
<tr>
    <td> местонахождение: </td><td>{$producer['LOCATION']}</td>
</tr>
<tr><td></td><td></td></tr>

<tr>
    <td>транспортной компании</td><td>{$shipment['NAME']}</td>
</tr>
<tr>
    <td> ИНН: </td><td>{$shipment['INN']}</td>
</tr>
<tr>
    <td> ОГРН: </td><td>{$shipment['OGRN']}</td>
</tr>
<tr>
    <td> Юр. адрес:</td><td>{$shipment['JURADDR']}</td>
</tr>
<tr>
    <td>Дата выдачи доверенности:</td><td>{$date}</td>
</tr>
<tr>
    <td>Срок действия доверенности:</td><td>20 рабочих дней</td>
</tr>
<tr>
    <td>Контакты:</td><td></td>
</tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>

<tr>
    <td>Подпись:</td><td>...</td>
</tr>
<tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr>
    <td>Печать:</td><td>...</td>
</tr>
<tr><td></td><td></td></tr>


</tbody>
</table>
EOD;

// Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . COption::GetOptionString("main", "upload_dir", "upload") . "/pdf/proxy/proxy$orderId.pdf", 'F');

//============================================================+
// END OF FILE
//============================================================+
        /*$_SERVER["DOCUMENT_ROOT"].'/proxy.pdf'*/
    }
}

