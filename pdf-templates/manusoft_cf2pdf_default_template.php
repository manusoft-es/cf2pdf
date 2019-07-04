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
        top: 100px;
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
        height: 850px;
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 2%;
      }
      #form_title {
        text-align: center;
      }
      #form_data {
        margin-top: 15px;
        width: 100%;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        height: 850px;
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
      .pie {
        width: 80%;
        position: absolute;
        top: 950px;
        margin-left: 10%;
        margin-right: 10%;
        text-align: justify;
        font-size: 10px;
      }
    </style>
    <page>
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
      <div class="info">
        <div id="form_title">
          <h1><?php echo $form_title; ?></h1>
        </div>
        <div id="form_data">
          <table id="data_table" border="1">
          <?php foreach (array_keys($form_data) as $index) {
                  if ($index != 'form_id' && $index != "form_date") { ?>
            <tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr><tr>
              <th><?php echo str_replace("your-","",$index); ?></th>
              <td><?php echo $form_data[$index]; ?></td>
            </tr>
          <?php   }
                } ?>
          </table>
        </div>
      </div>
      <div class="pie">
        <p>
          <small>Este mensaje y sus archivos son confidenciales. No está permitida su reproducción o distribución sin la autorización expresa de la ASOCIACIÓN SCOUT SAN BENITO. Si usted no es el destinatario previsto, cualquier uso, acceso o copia de este mensaje queda desautorizada. Si ha recibido este mensaje por error, por favor bórrelo e infórmenos por esta misma vía.<br><br>
            De acuerdo con el REGLAMENTO UE 2016/679 y la LOPD, le comunicamos que sus datos personales y dirección de correo electrónico forman parte de un fichero automatizado cuyo responsable es la ASOCIACIÓN SCOUT SAN BENITO. Si lo desea puede ejercer los derechos de acceso, rectificación o supresión, limitación del tratamiento, oposición del tratamiento o la portabilidad de los datos enviando un mensaje de correo electrónico a sanbenito@mscjerez.es indicando en el asunto el derecho que desea ejecutar.</small>
        </p>
    	</div>
    </page>
<?php
    $content = ob_get_clean();
    $html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    ob_end_clean();
    $html2pdf->output('test.pdf');
  } catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
  }
} else {
    die('No tienes permiso para hacer eso');
}
?>
