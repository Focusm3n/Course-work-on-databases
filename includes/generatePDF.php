<?
session_start();
require_once 'connect.php';
/**
 * @var connect $connect
 */
if (!$_SESSION['user']) {
    header("Location: index-Course.php");
}
$user = $_SESSION['user'];
//$query = "SELECT b.id, b.name_book, b.year_of_creation, b.description FROM request r JOIN book b ON b.id = r.book_fk JOIN users u on u.id = r.client_fk WHERE u.id = ".$user['id'];
//$books_data = mysqli_query($connect, $query);
//$books = mysqli_fetch_all($books_data);
//$str = "data: ";
//foreach ($books as $book) {
//    $str = $str . implode("  ", $book);
//}

function fetch_data()
{
    $user = $_SESSION['user'];
    $output = '';
    $query = "SELECT b.id, b.name_book, b.year_of_creation, b.description FROM request r JOIN book b ON b.id = r.book_fk JOIN users u on u.id = r.client_fk WHERE u.id = ".$user['id'];
    $connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_array($result))
    {

        $output .= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name_book'].'</td>
                        <td>'.$row['year_of_creation'].'</td>
                        <td>'.$row['description'].'</td>
                    </tr>';
    }
    return $output;
}
if(isset($_POST["generate_pdf"]))
{
    require_once ('../tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("Generatr PDF from DATABASE");
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->AddPage();
    $content = '';
    $content .= '  
      <h4 align="center">Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%">Id</th>  
                <th width="30%">Name book</th>  
                <th width="15%">Year of creation</th>  
                <th width="50%">Description</th>  
           </tr>  
      ';
    $content .= fetch_data();
    $content .= '</table>';
    $pdf->writeHTML($content);
    $pdf->Output('file.pdf', 'I');
}
