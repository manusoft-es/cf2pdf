<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
    $form_title = $_SESSION['form_title'];
    $form_data = $_SESSION['data'][$_GET['id']];
    
    isset($_SESSION['config']['url_img_sup']) ? $url_img_sup = $_SESSION['config']['url_img_sup'] : $url_img_sup = "";
    isset($_SESSION['config']['url_img_lat_sup']) ? $url_img_lat_sup = $_SESSION['config']['url_img_lat_sup'] : $url_img_lat_sup = "";
    isset($_SESSION['config']['url_img_lat_inf']) ? $url_img_lat_inf = $_SESSION['config']['url_img_lat_inf'] : $url_img_lat_inf = "";
    isset($_SESSION['config']['txt_lat']) ? $txt_lat = $_SESSION['config']['txt_lat'] : $txt_lat = "";
    isset($_SESSION['config']['txt_inf']) ? $txt_inf = $_SESSION['config']['txt_inf'] : $txt_inf = "";
    
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
        width: 60px;
        height: auto;
        margin-bottom: 30px;
      }
      .txt_lateral {
        rotate: 270;
        width: 600px;
        text-align: center;
        font-size: 11px;
        padding-bottom: 10px;
      }
      .logo_msc img{
        width: 50px;
        height: auto;
        margin-top: 30px;
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
        margin-left: 15%;
      }
      .pie {
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
        text-align: justify;
        font-size: 11px;
      }
    </style>
    <page backtop="30mm" backbottom="25mm" backleft="5mm" backright="0mm">
      <page_header>
        <div class="cabecera">
          <img src="<?php echo $url_img_sup; ?>" />
        </div>
        <div class="lateral">
          <div class="logo_andalucia">
            <img src="<?php echo $url_img_lat_sup; ?>" />
          </div>
          <div class="txt_lateral">
              <p>
              	<small>
              		<?php echo substr($txt_lat,0,520); ?>
                </small>
              </p>
          </div>
          <div class="logo_msc">
            <img src="<?php echo $url_img_lat_inf; ?>" />
          </div>
        </div>
      </page_header>
      <page_footer>
        <div class="pie">
          <p>
            <small><?php echo substr($txt_inf,0,880); ?></small>
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