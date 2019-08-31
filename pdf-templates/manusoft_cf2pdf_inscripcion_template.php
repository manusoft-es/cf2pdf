<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
    $form_data = $_SESSION['data'][$_GET['id']];
    $form_title = "Solicitud de inscripción";
    
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
    
    $nombre_nino_a = $form_data['nombre_nino_a'];
    $sexo_nino_a = $form_data['sexo_nino_a'];
    $fecha_nacimiento_nino_a = $form_data['fecha_nacimiento_nino_a'];
    $dni_nino_a = $form_data['dni_nino_a'];
    $rama = $form_data['rama'];
    $direccion_nino_a = $form_data['direccion_nino_a'];
    $cp_nino_a = $form_data['cp_nino_a'];
    $localidad_nino_a = $form_data['localidad_nino_a'];
    $provincia_nino_a = $form_data['provincia_nino_a'];
    $tlf_fijo_nino_a = $form_data['tlf_fijo_nino_a'];
    $tlf_movil_nino_a = $form_data['tlf_movil_nino_a'];
    $seguridad_social_nino_a = $form_data['seguridad_social_nino_a'];
    $email_nino_a = $form_data['email_nino_a'];
    $fecha_ingreso = $form_data['fecha_ingreso'];
    $nombre_padre = $form_data['nombre_padre'];
    $fecha_nacimiento_padre = $form_data['fecha_nacimiento_padre'];
    $dni_padre = $form_data['dni_padre'];
    $direccion_padre = $form_data['direccion_padre'];
    $cp_padre = $form_data['cp_padre'];
    $localidad_padre = $form_data['localidad_padre'];
    $provincia_padre = $form_data['provincia_padre'];
    $profesion_padre = $form_data['profesion_padre'];
    $tlf_fijo_padre = $form_data['tlf_fijo_padre'];
    $tlf_movil_padre = $form_data['tlf_movil_padre'];
    $email_padre = $form_data['email_padre'];
    $nombre_madre = $form_data['nombre_madre'];
    $fecha_nacimiento_madre = $form_data['fecha_nacimiento_madre'];
    $dni_madre = $form_data['dni_madre'];
    $direccion_madre = $form_data['direccion_madre'];
    $cp_madre = $form_data['cp_madre'];
    $localidad_madre = $form_data['localidad_madre'];
    $provincia_madre = $form_data['provincia_madre'];
    $profesion_madre = $form_data['profesion_madre'];
    $tlf_fijo_madre = $form_data['tlf_fijo_madre'];
    $tlf_movil_madre = $form_data['tlf_movil_madre'];
    $email_madre = $form_data['email_madre'];
    $firma = $form_data['firma'];
    
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
			<div class="txt_1" style="margin-top:2%; margin-bottom:2%;">
				<p style="text-align:justify;">
					Yo <?php if ($nombre_padre != "") { echo "<b>".strtoupper($nombre_padre)."</b>"; } else { echo "<b>".strtoupper($nombre_madre)."</b>"; } ?> con DNI
					<?php if ($dni_padre != "") { echo "<b>".$dni_padre."</b>"; } else { echo "<b>".$dni_madre."</b>"; } ?> solicito la inscripción
					de mi hijo/a <?php echo "<b>".strtoupper($nombre_nino_a)."</b>"; ?> en <?php echo strtoupper($nombre_grupo); ?> con sede en <?php echo strtoupper($poblacion_grupo)." (".strtoupper($provincia_grupo).")"; ?>.
				</p>
			</div><br>
			<div class="datos_nino_a" style="width:100%;">
				<table border="1">
					<tr>
						<td colspan="7" style="background-color:#a6a6a6; border:1px solid black; padding:5 220px;">
							<b>DATOS PERSONALES NIÑO/A</b>
						</td>
					</tr>
					<tr>
						<td colspan="5"><b>Nombre y apellidos: </b><?php echo $nombre_nino_a; ?></td>
						<td colspan="2"><b>Sexo: </b><?php echo $sexo_nino_a; ?></td>
					</tr>
					<tr>
						<td colspan="3"><b>Fecha de nacimiento: </b><?php echo explode("-",$fecha_nacimiento_nino_a)[2]."/".explode("-",$fecha_nacimiento_nino_a)[1]."/".explode("-",$fecha_nacimiento_nino_a)[0]; ?></td>
						<td colspan="2"><b>D.N.I.: </b><?php echo $dni_nino_a; ?></td>
						<td colspan="2"><b>Rama: </b><?php echo $rama; ?></td>
					</tr>
					<tr>
						<td colspan="7"><b>Dirección: </b><?php echo $direccion_nino_a; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>C.P.: </b><?php echo $cp_nino_a; ?></td>
						<td colspan="3"><b>Localidad: </b><?php echo $localidad_nino_a; ?></td>
						<td colspan="2"><b>Provincia: </b><?php echo $provincia_nino_a; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Tlf. Fijo: </b><?php echo $tlf_fijo_nino_a; ?></td>
						<td colspan="2"><b>Móvil: </b><?php echo $tlf_movil_nino_a; ?></td>
						<td colspan="3"><b>S.S: </b><?php echo $seguridad_social_nino_a; ?></td>
					</tr>
					<tr>
						<td colspan="4"><b>Email: </b><?php echo $email_nino_a; ?></td>
						<td colspan="3"><b>Fecha de ingreso: </b><?php echo explode("-",$fecha_ingreso)[2]."/".explode("-",$fecha_ingreso)[1]."/".explode("-",$fecha_ingreso)[0]; ?></td>
					</tr>
					<tr>
						<td colspan="7" style="background-color:#a6a6a6; border:1px solid black; padding:5 220px;">
							<b>DATOS FAMILIARES</b>
						</td>
					</tr>
					<tr>
						<td colspan="7"><b>Nombre y apellidos Padre o Tutor: </b><?php echo $nombre_padre; ?></td>
					</tr>
					<tr>
						<td colspan="5"><b>Fecha de nacimiento: </b><?php echo explode("-",$fecha_nacimiento_padre)[2]."/".explode("-",$fecha_nacimiento_padre)[1]."/".explode("-",$fecha_nacimiento_padre)[0]; ?></td>
						<td colspan="2"><b>D.N.I.: </b><?php echo $dni_padre; ?></td>
					</tr>
					<tr>
						<td colspan="5"><b>Dirección: </b><?php echo $direccion_padre; ?></td>
						<td colspan="2"><b>C.P.: </b><?php echo $cp_padre; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Localidad: </b><?php echo $localidad_padre; ?></td>
						<td colspan="2"><b>Provincia: </b><?php echo $provincia_padre; ?></td>
						<td colspan="3"><b>Profesión: </b><?php echo $profesion_padre; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Tlf. Fijo: </b><?php echo $tlf_fijo_padre; ?></td>
						<td colspan="2"><b>Móvil: </b><?php echo $tlf_movil_padre; ?></td>
						<td colspan="3"><b>Email: </b><?php echo $email_padre; ?></td>
					</tr>
					<tr>
						<td colspan="7" style="background-color:#a6a6a6; border:1px solid black; padding:10 220px;"></td>
					</tr>
					<tr>
						<td colspan="7"><b>Nombre y apellidos Madre o Tutor: </b><?php echo $nombre_madre; ?></td>
					</tr>
					<tr>
						<td colspan="5"><b>Fecha de nacimiento: </b><?php echo explode("-",$fecha_nacimiento_madre)[2]."/".explode("-",$fecha_nacimiento_madre)[1]."/".explode("-",$fecha_nacimiento_madre)[0]; ?></td>
						<td colspan="2"><b>D.N.I.: </b><?php echo $dni_madre; ?></td>
					</tr>
					<tr>
						<td colspan="5"><b>Dirección: </b><?php echo $direccion_madre; ?></td>
						<td colspan="2"><b>C.P.: </b><?php echo $cp_madre; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Localidad: </b><?php echo $localidad_madre; ?></td>
						<td colspan="2"><b>Provincia: </b><?php echo $provincia_madre; ?></td>
						<td colspan="3"><b>Profesión: </b><?php echo $profesion_madre; ?></td>
					</tr>
					<tr>
						<td colspan="2"><b>Tlf. Fijo: </b><?php echo $tlf_fijo_madre; ?></td>
						<td colspan="2"><b>Móvil: </b><?php echo $tlf_movil_madre; ?></td>
						<td colspan="3"><b>Email: </b><?php echo $email_madre; ?></td>
					</tr>
				</table>
				<div class="firma" style="margin-top:5%;">
					<p style="margin-left:10%;">Fdo: <?php if ($nombre_padre != "") { echo $nombre_padre; } else { echo $nombre_madre; } ?></p>
					<div class="firma" style="text-align:center;">
						<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" />
					</div>
				</div>
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