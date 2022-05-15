<?php
require_once 'connect.php';
/**
 * @var connect $connect
 */
require_once ('../tcpdf/tcpdf.php');
$quere = "SELECT * FROM book";
$books_data = mysqli_query($connect, $quere);
$books = mysqli_fetch_all($books_data);
$str = "data: ";
foreach ($books as $book) {
    $str = $str . implode(" ", $book);
}
// Создаем новый PDF документ
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
// Устанавливаем информацию о документе
$pdf->SetAuthor('Имя автора');
$pdf->SetTitle('Название документа');
// Устанавливаем данные заголовка по умолчанию
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// Устанавливаем верхний и нижний колонтитулы
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// Устанавливаем моноширинный шрифт по умолчанию
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// Устанавливаем отступы
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// Устанавливаем автоматические разрывы страниц
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// Устанавливаем шрифт
//$pdf->SetFont('dejavusans', '', 14, '', true);
// Добавляем страницу
$pdf->AddPage();
// Устанавливаем текст
$html = <<<EOD
<h1>This is unloading data from a database.</h1>
<p>
    $str
</p>
EOD;
// Выводим текст с помощью writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Закрываем и выводим PDF документ
$pdf->Output('document.pdf', 'I');
