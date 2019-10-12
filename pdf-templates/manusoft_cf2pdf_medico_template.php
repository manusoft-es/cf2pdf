<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
    if (isset($_GET['id'])) {
        $form_data = $_SESSION['data'][$_GET['id']];
        $form_title = "Datos Médicos";
        
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
        
        $fecha_cumplimentacion = $form_data['fecha_cumplimentacion'];
        $nombre = $form_data['nombre'];
        $fecha_nacimiento = $form_data['fecha_nacimiento'];
        $peso = $form_data['peso'];
        $enfermedades = $form_data['enfermedades'];
        $alergias = $form_data['alergias'];
        $problemas_leves = $form_data['problemas_leves'];
        $atencion_especial = $form_data['atencion_especial'];
        $otros = $form_data['otros'];
        $declaracion = $form_data['declaro'];
        $max_urgencia = $form_data['autorizo_1'];
        $medicacion = $form_data['autorizo_2'];
        $nombre_padre = $form_data['nombre_padre'];
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
        			<div class="doc_text_1" style="margin-bottom:-5%;">
        				<p>
        					<b>Fecha de cumplimentación:</b> <?php echo explode('-', $fecha_cumplimentacion)[2]."/".explode('-', $fecha_cumplimentacion)[1]."/".explode('-',$fecha_cumplimentacion)[0]; ?><br>
        					<b>Nombre y Apellidos:</b> <?php echo strtoupper($nombre); ?><br>
        					<b>Fecha nacimiento:</b> <?php echo explode('-', $fecha_nacimiento)[2]."/".explode('-', $fecha_nacimiento)[1]."/".explode('-',$fecha_nacimiento)[0]; ?> <span style="margin-left:5%"><b>Peso: </b><?php echo $peso; ?></span>
        				</p>
        				<div>
        					<b style="text-align:justify;">
        						Enfermedades (indicar qué tratamiento sigue en ese caso):
        					</b><br>
        					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
        						<?php echo $enfermedades; ?>
        					</div>
        				</div>
        				<div style="margin-top:3%;">
        					<b style="text-align:justify;">
        						Alergias (alimentos, medicamentos, ambientales, otros):
        					</b><br>
        					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
        						<?php echo $alergias; ?>
        					</div>
        				</div>
        				<div style="margin-top:3%;">
        					<b style="text-align:justify;">
        						Problemas leves comunes (frecuentes dolores de cabeza, resfriado, esguince de tobillo,
        						dolor de espalda, etc.)	y tratamiento que sigue	en estos casos,	tanto medicación como
        						otros:
        					</b><br>
        					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
        						<?php echo $problemas_leves; ?>
        					</div>
        				</div>
        				<div style="margin-top:3%;">
        					<b style="text-align:justify;">
        						¿Requiere alguna atención especial? (Nocturnas, por carácter…)
        					</b><br>
        					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
        						<?php echo $atencion_especial; ?>
        					</div>
        				</div>
        				<div style="margin-top:3%;">
        					<b style="text-align:justify;">
        					Indíquenos cualquier otra observación que debamos saber. Si es posible, adjuntar
        					cualquier documento para completar la información anterior, como instrucción de
        					tratamiento, autorización o informemédico.
        				</b><br>
            				<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
            					<?php echo $otros; ?>
            				</div>
            			</div>
            		</div>
            		<div class="declaro" style="margin-left:2.5%;">
            			<p><b>DECLARO:</b></p>
            			<table>
            				<tr>
            					<td>
            						<div style="width:15px; height:15px; border:1px solid #000; display:inline-block; text-align:center; font-size:18px;">
            							<b><?php if ($declaracion) { ?>X<?php } ?></b>
            						</div>
            					</td>
            					<td>
            						<div style="width:600px; text-align:justify;">
            							Que todos los datos anteriormente expuestos se corresponden con la realidad y que informaré de los cambios.
            						</div>
            					</td>
            				</tr>
            			</table>
            		</div>
            		<div class="autorizo" style="margin-left:2.5%;">
            			<p><b>AUTORIZO:</b></p>
            			<table>
            				<tr>
            					<td>
        							<div style="width:15px; height:15px; border: 1px solid #000; display: inline-block; text-align:center; font-size:18px;">
        								<b><?php if ($max_urgencia) { ?>X<?php } ?></b>
        							</div>
        						</td>
        						<td>
        							<div style="width:600px; text-align:justify;">
        								A los responsables de la actividad, en caso de máxima urgencia, bajo
        								conocimiento y prescripción de un facultativo, a tomar las decisiones médicas
        								necesarias, si ha sido imposible mi localización.
        							</div>
        						</td>
        					</tr>
        					<tr>
        						<td>
        							<div style="width:15px; height:15px; border: 1px solid #000; display: inline-block; text-align:center; font-size:18px;">
        								<b><?php if ($medicacion) { ?>X<?php } ?></b>
        							</div>
        						</td>
        						<td>
        							<div style="width:600px; text-align:justify;">
        								Que el responsable scout administre la medicación detallada por las padres
        								en esta autorización.
        							</div>
        						</td>
        					</tr>
        				</table>
        			</div>
        			<div class="firma">
        				<p style="margin-left:10%;">Fdo: <?php echo $nombre_padre; ?></p>
        				<div class="firma" style="text-align:center;">
        					<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" style="max-width:250px;" />
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
            $html2pdf->output($form_title.' '.$nombre.'.pdf');
          } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
          }
    } else {
        try {
            ob_start();
            foreach ($_SESSION['data_varios'] as $form_data) {
                $form_title = "Datos Médicos";
                
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
                
                $fecha_cumplimentacion = $form_data['fecha_cumplimentacion'];
                $nombre = $form_data['nombre'];
                $fecha_nacimiento = $form_data['fecha_nacimiento'];
                $peso = $form_data['peso'];
                $enfermedades = $form_data['enfermedades'];
                $alergias = $form_data['alergias'];
                $problemas_leves = $form_data['problemas_leves'];
                $atencion_especial = $form_data['atencion_especial'];
                $otros = $form_data['otros'];
                $declaracion = $form_data['declaro'];
                $max_urgencia = $form_data['autorizo_1'];
                $medicacion = $form_data['autorizo_2'];
                $nombre_padre = $form_data['nombre_padre'];
                $firma = $form_data['firma'];
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
            			<div class="doc_text_1" style="margin-bottom:-5%;">
            				<p>
            					<b>Fecha de cumplimentación:</b> <?php echo explode('-', $fecha_cumplimentacion)[2]."/".explode('-', $fecha_cumplimentacion)[1]."/".explode('-',$fecha_cumplimentacion)[0]; ?><br>
            					<b>Nombre y Apellidos:</b> <?php echo strtoupper($nombre); ?><br>
            					<b>Fecha nacimiento:</b> <?php echo explode('-', $fecha_nacimiento)[2]."/".explode('-', $fecha_nacimiento)[1]."/".explode('-',$fecha_nacimiento)[0]; ?> <span style="margin-left:5%"><b>Peso: </b><?php echo $peso; ?></span>
            				</p>
            				<div>
            					<b style="text-align:justify;">
            						Enfermedades (indicar qué tratamiento sigue en ese caso):
            					</b><br>
            					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
            						<?php echo $enfermedades; ?>
            					</div>
            				</div>
            				<div style="margin-top:3%;">
            					<b style="text-align:justify;">
            						Alergias (alimentos, medicamentos, ambientales, otros):
            					</b><br>
            					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
            						<?php echo $alergias; ?>
            					</div>
            				</div>
            				<div style="margin-top:3%;">
            					<b style="text-align:justify;">
            						Problemas leves comunes (frecuentes dolores de cabeza, resfriado, esguince de tobillo,
            						dolor de espalda, etc.)	y tratamiento que sigue	en estos casos,	tanto medicación como
            						otros:
            					</b><br>
            					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
            						<?php echo $problemas_leves; ?>
            					</div>
            				</div>
            				<div style="margin-top:3%;">
            					<b style="text-align:justify;">
            						¿Requiere alguna atención especial? (Nocturnas, por carácter…)
            					</b><br>
            					<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
            						<?php echo $atencion_especial; ?>
            					</div>
            				</div>
            				<div style="margin-top:3%;">
            					<b style="text-align:justify;">
            					Indíquenos cualquier otra observación que debamos saber. Si es posible, adjuntar
            					cualquier documento para completar la información anterior, como instrucción de
            					tratamiento, autorización o informemédico.
            				</b><br>
                				<div class="cuadro_medico" style="border:1px solid black; margin-top:5px; padding:5px;">
                					<?php echo $otros; ?>
                				</div>
                			</div>
                		</div>
                		<div class="declaro" style="margin-left:2.5%;">
                			<p><b>DECLARO:</b></p>
                			<table>
                				<tr>
                					<td>
                						<div style="width:15px; height:15px; border:1px solid #000; display:inline-block; text-align:center; font-size:18px;">
                							<b><?php if ($declaracion) { ?>X<?php } ?></b>
                						</div>
                					</td>
                					<td>
                						<div style="width:600px; text-align:justify;">
                							Que todos los datos anteriormente expuestos se corresponden con la realidad y que informaré de los cambios.
                						</div>
                					</td>
                				</tr>
                			</table>
                		</div>
                		<div class="autorizo" style="margin-left:2.5%;">
                			<p><b>AUTORIZO:</b></p>
                			<table>
                				<tr>
                					<td>
            							<div style="width:15px; height:15px; border: 1px solid #000; display: inline-block; text-align:center; font-size:18px;">
            								<b><?php if ($max_urgencia) { ?>X<?php } ?></b>
            							</div>
            						</td>
            						<td>
            							<div style="width:600px; text-align:justify;">
            								A los responsables de la actividad, en caso de máxima urgencia, bajo
            								conocimiento y prescripción de un facultativo, a tomar las decisiones médicas
            								necesarias, si ha sido imposible mi localización.
            							</div>
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<div style="width:15px; height:15px; border: 1px solid #000; display: inline-block; text-align:center; font-size:18px;">
            								<b><?php if ($medicacion) { ?>X<?php } ?></b>
            							</div>
            						</td>
            						<td>
            							<div style="width:600px; text-align:justify;">
            								Que el responsable scout administre la medicación detallada por las padres
            								en esta autorización.
            							</div>
            						</td>
            					</tr>
            				</table>
            			</div>
            			<div class="firma">
            				<p style="margin-left:10%;">Fdo: <?php echo $nombre_padre; ?></p>
            				<div class="firma" style="text-align:center;">
            					<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" style="max-width:250px;" />
            				</div>
            			</div>
            		</div>
            	</page>
<?php
            }
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
        unset($_SESSION['data_varios']);
    }
} else {
    die('No tienes permiso para hacer eso');
}
?>