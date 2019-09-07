<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
    $form_data = $_SESSION['data'][$_GET['id']];
    $form_title = "Consentimiento tratamiento de datos de carácter personal";
    
    isset($_SESSION['config']['url_img_sup']) ? $url_img_sup = $_SESSION['config']['url_img_sup'] : $url_img_sup = "";
    isset($_SESSION['config']['url_img_lat_sup']) ? $url_img_lat_sup = $_SESSION['config']['url_img_lat_sup'] : $url_img_lat_sup = "";
    isset($_SESSION['config']['url_img_lat_inf']) ? $url_img_lat_inf = $_SESSION['config']['url_img_lat_inf'] : $url_img_lat_inf = "";
    isset($_SESSION['config']['txt_lat']) ? $txt_lat = $_SESSION['config']['txt_lat'] : $txt_lat = "";
    isset($_SESSION['config']['txt_inf']) ? $txt_inf = $_SESSION['config']['txt_inf'] : $txt_inf = "";
    
    $nombre_grupo = $_SESSION['config']['nombre_grupo'];
    $cif_grupo = $_SESSION['config']['cif_grupo'];
    $email_grupo = $_SESSION['config']['email_grupo'];
    $direccion_grupo = $_SESSION['config']['direccion_grupo'];
    $poblacion_grupo = $_SESSION['config']['poblacion_grupo'];
    $provincia_grupo = $_SESSION['config']['provincia_grupo'];
    $cp_grupo = $_SESSION['config']['cp_grupo'];
    
    $autoriza = $form_data['tratamiento_imagenes'];
    $nombre_nino_a = $form_data['nombre_nino_a'];
    $nombre_padre_madre = $form_data['nombre_padre_madre'];
    $dni_padre_madre = $form_data['dni_padre_madre'];
    $firma = $form_data['firma'];
    $fecha = $form_data['fecha'];
    
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
				<?php if ($url_img_sup != "" ) { ?>
				<img src="<?php echo $url_img_sup; ?>" />
				<?php } ?>
			</div>
			<div class="lateral">
				<div class="logo_andalucia">
					<?php if ($url_img_lat_sup != "" ) { ?>
					<img src="<?php echo $url_img_lat_sup; ?>" />
					<?php } ?>
				</div>
				<div class="txt_lateral">
					<p><small><?php echo substr($txt_lat,0,520); ?></small></p>
				</div>
				<div class="logo_msc">
					<?php if ($url_img_lat_inf != "" ) { ?>
					<img src="<?php echo $url_img_lat_inf; ?>" />
					<?php } ?>
				</div>
			</div>
		</page_header>
		<page_footer>
			<div class="pie">
				<p><small><?php echo substr($txt_inf,0,880); ?></small></p>
			</div>
		</page_footer>
		<div class="info">
			<div class="doc_title_1" style="text-align:center;">
				<h3><u><?php echo $form_title; ?></u></h3>
			</div>
			<div class="doc_cabecera">
				<p>
					<b><?php echo strtoupper($nombre_grupo); ?></b><br>
					CIF: <?php echo strtoupper($cif_grupo); ?><br>
					DIRECCIÓN: <?php echo strtoupper($direccion_grupo); ?><br>
					POBLACIÓN: <?php echo $cp_grupo." ".strtoupper($poblacion_grupo)." (".strtoupper($provincia_grupo).")"; ?><br>
					<a href="mailto:<?php echo $email_grupo; ?>"><?php echo $email_grupo; ?></a>
				</p>
			</div>
			<div class="texto_1">
				<p style="text-align:justify;">
					En cumplimiento del RGPD UE 2016/679 de Protección de Datos de Carácter Personal le
					informamos de que sus datos personales pasarán a formar parte de los sistemas de información
					de <?php echo strtoupper($nombre_grupo); ?> cuya finalidad es la gestión de los datos de los socios
					para su coordinación integral y su control, así como el envío de comunicaciones.
					<br><br>
					La legitimación del tratamiento se basa en la aplicación del artículo 6.1a del citado RGPD, por la
					que el interesado otorga a <?php echo strtoupper($nombre_grupo); ?> el consentimiento para el
					tratamiento de sus datos personales. Los datos que nos ha proporcionado se conservarán
					mientras no solicite su supresión o cancelación y siempre que resulten adecuados, pertinentes y
					limitados a lo necesario para los fines para los que sean tratados.
					Sus datos no serán comunicados a terceros salvo en las excepciones previstas por obligaciones
					legales.
				</p>
			</div><br>
			<div class="autorizo" style="margin-left:2.5%;">
				<table>
					<tr>
						<td>
							<div style="width:20px; height:20px; border: 1px solid #000; display: inline-block; text-align:center; font-size:18px;">
								<b><?php if ($autoriza) { ?>X<?php } ?></b>
							</div>
						</td>
						<td>
							<b><u>Autorizo</u></b> la captación y difusión de imágenes durante las actividades realizadas por el grupo.
						</td>
					</tr>
				</table>
			</div>
			<div class="text_2">
				<p style="text-align:justify;">
					Podrá ejercitar su derecho a solicitar el acceso a sus datos, la rectificación o supresión, la limitación
					del tratamiento, la oposición del tratamiento o la portabilidad de los datos, dirigiendo un escrito
					junto a la copia de su DNI a en la siguiente dirección: <a href="mailto:<?php echo $email_grupo; ?>"><?php echo $email_grupo; ?></a>
					<br><br>
					En caso de disconformidad, Vd. tiene derecho a elevar una reclamación ante la Agencia Española
					de Protección de Datos (<a href="www.agpd.es">www.agpd.es</a>).
					He sido informado y autorizo expresamente el tratamiento de mi hijo/a:
				</p>
			</div>
			<div class="autorizacion">
				<p>NOMBRE Y APELLIDOS: <b><?php echo $nombre_nino_a; ?></b></p>
				<p>
					NOMBRE Y APELLIDOS: <b><?php echo $nombre_padre_madre; ?></b><br><br>
					D.N.I.: <b><?php echo $dni_padre_madre; ?></b><br><br>
					Fecha: <b><?php echo explode("-",$fecha)[2]."/".explode("-",$fecha)[1]."/".explode("-",$fecha)[0]; ?></b><br><br>
					Firma:
				</p>
			</div>
			<div class="firma" style="text-align:center; margin-left:15%;">
				<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" />
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