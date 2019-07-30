<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
  $form_title = $_SESSION['form_title'];
  $form_data = $_SESSION['data'][$_GET['id']];
  try {
    ob_start();
?>
    <style>
      .cabecera {
        text-align: center;
        width: 80%;
        margin-left: 10%;
      }
      .cabecera img {
        width: 12%;
      }
      .lateral {
        width: 10%;
        top: 180px;
        position: absolute;
      }
      .logo_andalucia img {
        width: 70%;
      }
      .txt_lateral img {
        width: 40%;
        margin-top: 2.5%;
        margin-bottom: 2.5%;
        margin-left: 20%;
      }
      .logo_msc img{
        width: 70%;
      }
      .info {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
      }
      #form_data {
        width: 100%;
      }
      #form_title {
        text-align: center;
        font-size: 24px;
      }
      table {
        border-collapse: collapse;
        width: 100%;
      }
      th, td {
        padding: 15px;
      }
      th {
        width: 20%;
        background-color: #f2f2f2;
      }
      td {
        width: 80%;
      }
      .img_form {
        margin-left: 25%;
        width: 27%;
      }
      .pie {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
        text-align: justify;
        font-size: 10px;
      }
    </style>
    <page backtop="30mm" backbottom="25mm" backleft="5mm" backright="0mm">
      <page_header>
        <div class="cabecera">
          <img src="../images/logo-dele.png" />
        </div>
        <div class="lateral">
          <div class="logo_andalucia">
            <img src="../images/logo-andalucia.png" />
          </div>
          <div class="txt_lateral">
            <img src="../images/lateral.png" />
          </div>
          <div class="logo_msc">
            <img src="../images/logo-msc.png" />
          </div>
        </div>
      </page_header>
      <page_footer>
        <div class="pie">
          <p>
            <small>Este mensaje y sus archivos son confidenciales. No está permitida su reproducción o distribución sin la autorización expresa de la ASOCIACIÓN SCOUT SAN BENITO. Si usted no es el destinatario previsto, cualquier uso, acceso o copia de este mensaje queda desautorizada. Si ha recibido este mensaje por error, por favor bórrelo e infórmenos por esta misma vía.<br><br>
              De acuerdo con el REGLAMENTO UE 2016/679 y la LOPD, le comunicamos que sus datos personales y dirección de correo electrónico forman parte de un fichero automatizado cuyo responsable es la ASOCIACIÓN SCOUT SAN BENITO. Si lo desea puede ejercer los derechos de acceso, rectificación o supresión, limitación del tratamiento, oposición del tratamiento o la portabilidad de los datos enviando un mensaje de correo electrónico a sanbenito@mscjerez.es indicando en el asunto el derecho que desea ejecutar.</small>
          </p>
      	</div>
      </page_footer>
      <div class="info">
        <div id="form_data">
          <table id="data_table" border="1">
            <tr>
              <td id="form_title" colspan="2"><strong><?php echo $form_title; ?></strong></td>
            </tr>
          <?php foreach (array_keys($form_data) as $index) {
                  if ($index != 'form_id' && $index != "form_date" && strpos($index,"-attachment") === false && strpos($index,"-inline") === false) { ?>
            <tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td>
          <?php if (is_array($form_data[$index])) {
                  echo implode(",",$form_data[$index]);
                } else {
                  if (preg_match("/^((http|https):\/\/?)[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/?))$/",str_replace("&#047;", "/", $form_data[$index]))) {
                    if (strpos($form_data[$index],".png") === false) {
                        echo $form_data[$index];
                    } else {
                        echo "<img class='img_form' src='".str_replace("&#047;","/",$form_data[$index])."' />";
                    }
                  } else {
                    echo $form_data[$index];
                  }
                }
          ?>
              </td>
            </tr>
          <?php   }
                } ?>
          </table>
        </div>
      </div>
    </page>
<?php
    $content = ob_get_clean();
    $html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf->setTestTdInOnePage(false);
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    ob_end_clean();
    $html2pdf->output($form_title.'.pdf');
  } catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
  }
} else {
    die('No tienes permiso para hacer eso');
}
?>
