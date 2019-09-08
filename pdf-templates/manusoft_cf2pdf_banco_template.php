<?php
session_start();
require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_SESSION['start'])) {
    if (isset($_GET['id'])) {
        $form_data = $_SESSION['data'][$_GET['id']];
        $form_title = "Domiciliación bancaria";
        
        $periodicidad = $_SESSION['config']['periodicidad'];
        $cuota = $_SESSION['config']['cuota'];
        
        isset($_SESSION['config']['url_img_sup']) ? $url_img_sup = $_SESSION['config']['url_img_sup'] : $url_img_sup = "";
        isset($_SESSION['config']['url_img_lat_sup']) ? $url_img_lat_sup = $_SESSION['config']['url_img_lat_sup'] : $url_img_lat_sup = "";
        isset($_SESSION['config']['url_img_lat_inf']) ? $url_img_lat_inf = $_SESSION['config']['url_img_lat_inf'] : $url_img_lat_inf = "";
        isset($_SESSION['config']['txt_lat']) ? $txt_lat = $_SESSION['config']['txt_lat'] : $txt_lat = "";
        isset($_SESSION['config']['txt_inf']) ? $txt_inf = $_SESSION['config']['txt_inf'] : $txt_inf = "";
        
        $familia = $form_data['familia'];
        $importe = $form_data['importe'];
        $nombre_titular = $form_data['titular'];
        $dni_titular = $form_data['dni'];
        $num_cuenta = $form_data['num_cuenta'];
        $firma = $form_data['firma'];
        $fecha = $form_data['fecha'];
        
        if (explode("-",$fecha)[1] == 1) {
            $mes = "Enero";
        } else if (explode("-",$fecha)[1] == 2) {
            $mes = "Febrero";
        } else if (explode("-",$fecha)[1] == 3) {
            $mes = "Marzo";
        } else if (explode("-",$fecha)[1] == 4) {
            $mes = "Abril";
        } else if (explode("-",$fecha)[1] == 5) {
            $mes = "Mayo";
        } else if (explode("-",$fecha)[1] == 6) {
            $mes = "Junio";
        } else if (explode("-",$fecha)[1] == 7) {
            $mes = "Julio";
        } else if (explode("-",$fecha)[1] == 8) {
            $mes = "Agosto";
        } else if (explode("-",$fecha)[1] == 9) {
            $mes = "Septiembre";
        } else if (explode("-",$fecha)[1] == 10) {
            $mes = "Octubre";
        } else if (explode("-",$fecha)[1] == 11) {
            $mes = "Noviembre";
        } else if (explode("-",$fecha)[1] == 12) {
            $mes = "Diciembre";
        }
        
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
        				<h3><u>DOMICILIACIÓN BANCARIA</u></h3>
        			</div>
        			<div class="doc_text_1">
        				<p style="font-size:14px;">
        					<b>Familia:</b> <span style="font-size:18px;"><?php echo strtoupper($familia); ?></span>
        				</p>
        				<p style="color:red; font-size:14px;">
        					<b>El importe es el resultado de multiplicar <?php echo $cuota; ?> € (cuota de miembro del grupo) por el número de miembros que pertenecen al grupo.</b>
        				</p>
        				<br>
        				<table style="font-size:14px; width:100%;">
        					<tr>
        						<td style="width:65%;"><b>IMPORTE:</b> <span style="font-size:18px;"><?php echo $importe; ?></span> EUROS</td>
        						<td style="width:35%;"><b>PERIODICIDAD:</b> <span style="font-size:18px;"><?php echo strtoupper($periodicidad); ?></span></td>
        					</tr>
        				</table>
        			</div>
        			<div class="doc_title_2" style="text-align:center;">
        				<h4>ORDEN DE DOMICILIACIÓN DE ADEUDO DIRECTO</h4>
        			</div>
        			<div class="doc_text_1">
        				<br>
        				<table style="font-size:14px; width:100%;">
        					<tr>
        						<td style="width:75%;"><b>Titular Cuenta:</b> <span style="font-size:18px;"><?php echo strtoupper($nombre_titular); ?></span></td>
        						<td style="width:25%;"><b>D.N.I.:</b> <span style="font-size:18px;"><?php echo $dni_titular; ?></span></td>
        					</tr>
        				</table><br>
        				<p style="text-align:center;">
        					<span style="font-size:14px;">
        						Número de cuenta IBAN<br>
        						Mira tu talonario, libreta o extracto y cumplimenta los datos de la misma en su totalidad.
        					</span><br><br>
        					<span style="font-size:18px;">
        						<?php echo $num_cuenta; ?>
        					</span>
        				</p>
        				<p style="margin-left:10%;">
        					Firma del titular:
        				</p>
        				<div class="firma" style="text-align:center; margin-left:15%;">
        					<?php if ($firma != "" ) { ?>
        					<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" />
        					<?php } ?>
        				</div>
        				<p style="font-size:18px; text-align:center;">
        					<?php echo explode('-', $fecha)[2]." de ".$mes." de ".explode('-',$fecha)[0]; ?>
        				</p>
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
            $html2pdf->output($form_title.' '.$familia.'.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    } else {
        try {
            ob_start();
            foreach ($_SESSION['data_varios'] as $form_data) {
                $form_title = "Domiciliación bancaria";
                
                $periodicidad = $_SESSION['config']['periodicidad'];
                $cuota = $_SESSION['config']['cuota'];
                
                isset($_SESSION['config']['url_img_sup']) ? $url_img_sup = $_SESSION['config']['url_img_sup'] : $url_img_sup = "";
                isset($_SESSION['config']['url_img_lat_sup']) ? $url_img_lat_sup = $_SESSION['config']['url_img_lat_sup'] : $url_img_lat_sup = "";
                isset($_SESSION['config']['url_img_lat_inf']) ? $url_img_lat_inf = $_SESSION['config']['url_img_lat_inf'] : $url_img_lat_inf = "";
                isset($_SESSION['config']['txt_lat']) ? $txt_lat = $_SESSION['config']['txt_lat'] : $txt_lat = "";
                isset($_SESSION['config']['txt_inf']) ? $txt_inf = $_SESSION['config']['txt_inf'] : $txt_inf = "";
                
                $familia = $form_data['familia'];
                $importe = $form_data['importe'];
                $nombre_titular = $form_data['titular'];
                $dni_titular = $form_data['dni'];
                $num_cuenta = $form_data['num_cuenta'];
                $firma = $form_data['firma'];
                $fecha = $form_data['fecha'];
                
                if (explode("-",$fecha)[1] == 1) {
                    $mes = "Enero";
                } else if (explode("-",$fecha)[1] == 2) {
                    $mes = "Febrero";
                } else if (explode("-",$fecha)[1] == 3) {
                    $mes = "Marzo";
                } else if (explode("-",$fecha)[1] == 4) {
                    $mes = "Abril";
                } else if (explode("-",$fecha)[1] == 5) {
                    $mes = "Mayo";
                } else if (explode("-",$fecha)[1] == 6) {
                    $mes = "Junio";
                } else if (explode("-",$fecha)[1] == 7) {
                    $mes = "Julio";
                } else if (explode("-",$fecha)[1] == 8) {
                    $mes = "Agosto";
                } else if (explode("-",$fecha)[1] == 9) {
                    $mes = "Septiembre";
                } else if (explode("-",$fecha)[1] == 10) {
                    $mes = "Octubre";
                } else if (explode("-",$fecha)[1] == 11) {
                    $mes = "Noviembre";
                } else if (explode("-",$fecha)[1] == 12) {
                    $mes = "Diciembre";
                }
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
            				<h3><u>DOMICILIACIÓN BANCARIA</u></h3>
            			</div>
            			<div class="doc_text_1">
            				<p style="font-size:14px;">
            					<b>Familia:</b> <span style="font-size:18px;"><?php echo strtoupper($familia); ?></span>
            				</p>
            				<p style="color:red; font-size:14px;">
            					<b>El importe es el resultado de multiplicar <?php echo $cuota; ?> € (cuota de miembro del grupo) por el número de miembros que pertenecen al grupo.</b>
            				</p>
            				<br>
            				<table style="font-size:14px; width:100%;">
            					<tr>
            						<td style="width:65%;"><b>IMPORTE:</b> <span style="font-size:18px;"><?php echo $importe; ?></span> EUROS</td>
            						<td style="width:35%;"><b>PERIODICIDAD:</b> <span style="font-size:18px;"><?php echo strtoupper($periodicidad); ?></span></td>
            					</tr>
            				</table>
            			</div>
            			<div class="doc_title_2" style="text-align:center;">
            				<h4>ORDEN DE DOMICILIACIÓN DE ADEUDO DIRECTO</h4>
            			</div>
            			<div class="doc_text_1">
            				<br>
            				<table style="font-size:14px; width:100%;">
            					<tr>
            						<td style="width:75%;"><b>Titular Cuenta:</b> <span style="font-size:18px;"><?php echo strtoupper($nombre_titular); ?></span></td>
            						<td style="width:25%;"><b>D.N.I.:</b> <span style="font-size:18px;"><?php echo $dni_titular; ?></span></td>
            					</tr>
            				</table><br>
            				<p style="text-align:center;">
            					<span style="font-size:14px;">
            						Número de cuenta IBAN<br>
            						Mira tu talonario, libreta o extracto y cumplimenta los datos de la misma en su totalidad.
            					</span><br><br>
            					<span style="font-size:18px;">
            						<?php echo $num_cuenta; ?>
            					</span>
            				</p>
            				<p style="margin-left:10%;">
            					Firma del titular:
            				</p>
            				<div class="firma" style="text-align:center; margin-left:15%;">
            					<?php if ($firma != "" ) { ?>
            					<img src="<?php echo str_replace("&#047;", "/", $firma); ?>" />
            					<?php } ?>
            				</div>
            				<p style="font-size:18px; text-align:center;">
            					<?php echo explode('-', $fecha)[2]." de ".$mes." de ".explode('-',$fecha)[0]; ?>
            				</p>
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