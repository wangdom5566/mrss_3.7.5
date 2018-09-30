<?php
// +----------------------------------------------------------------------+
// | Meeting Room Scheduler System - (English)                            |
// | SAS Sistema de Agendamento de Salas - (Portuguese)                   |
// | Copyright (C) 2005/2006  Ighor Toth (igtoth@gmail.com)               |
// |                                                                      |
// | This program is free software; you can redistribute it and/or        |
// | modify it under the terms of the GNU General Public License          |
// | as published by the Free Software Foundation; either version 2       |
// | of the License, or (at your option) any later version.               |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor,                   |
// | Boston, MA  02110-1301, USA.                                         |
// +----------------------------------------------------------------------+
// | RSS - Room Scheduler System (English Version)                        |
// | SAS - Sistema de Agendamento de Sala (Portuguese Version)            |
// +----------------------------------------------------------------------+
// | Autor: Ighor Toth (igtoth@gmail.com) - http://www.ighor.com          |
// | Web-site: http://sourceforge.net/projects/rss                        |
// | DEVELOPED IN BRAZIL !!!                                              |
// +----------------------------------------------------------------------+
// | UPDATES:-                                                            |
// | Please read README.txt                                               |
// +----------------------------------------------------------------------+
// | Pages:                                                               |
// |         Room Scheduler     = http://www.your-site.com/index.php      |
// |             Demo           = http://mrss.ighor.com/index.php         |
// |             User           = 999995                                  |
// |             Password       = 123456                                  |
// |         Administrator page = http://www.your-site.com/adm.php        |
// |             Demo           = "Not available yet"                     |
// |             User           = admin                                   |
// |             Password       = abc123                                  |
// +----------------------------------------------------------------------+
// | Configuration file: conf.inc.php                                     |
// | DB structure: rss.sql                                                |
// | Bugs, translations or issues, write to: igtoth@netsite.com.br        |
// | ATTENTION: OLD VERSION: RSS - Room Scheduler System -- DISCONTINUED  |
// +----------------------------------------------------------------------+
include('languages/padrao.inc.php');
?>


		<TITLE><?php echo $L_TITULO; ?></TITLE>

			<style type="text/css">
			<!--
			.bordas {
				border: 1px solid #999999;
			}
			-->
			</style>



						<SCRIPT LANGUAGE="JavaScript">
					
						function envapa(){

							form = document.apagar
							form.action = 'adm4.php'
							form.submit();
						}
				
						</SCRIPT>




<?php

		
			include('conecta.php');


			// $nome=$_POST["nome"];
			// $sup=$_POST["sup"];
			// $nome1=$_GET["nome1"];
			
	
			if(($nome)||($nome1)||($sup)||($sam)){ // INICIO

				mysql_select_db($banco);

				?>
		
				<form name="sup" method="post" action="adm.php">
				<table width="100%">
					<tr>	
						<td>
							<font size=2 face="arial"><?php echo $L_ESCOLHA_USUARIO; ?>: &nbsp;

								<?php

								$sql = "SELECT * from sups ORDER BY nome_sup";
								$resultado = mysql_query($sql) or die(mysql_error());
								?>
								<select name="sup">
	
								<?php
								while($linha_sup=mysql_fetch_array($resultado)) { // INICIO WHILE_SUP
									if($linha_sup["matsup"]!="0"){
								?>
										<option value="<?php echo $linha_sup["matsup"]; ?>" <?php if($linha_sup["matsup"]==$sup){ echo(" selected"); $nome_sup=$linha_sup["nome_sup"]; } ?> > <?php echo $linha_sup["matsup"]; ?> - <?php echo $linha_sup["nome_sup"]; ?> </option>
								<?php
									}
								}
								?>
								</select>

							<input border="0" class="bordas" type="submit" name="supenv" value="<?php echo $L_BUSCAR; ?>">
						</td>
									<td align="right">

										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?salas=sim','_self');">
											<?php echo $L_SALAS; ?>
										</BUTTON>
										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('adm.php?novosusuarios=sim','_self');">
											<?php echo $L_USUARIOS; ?>
										</BUTTON>
											
									</td>
					</tr>
				</table>
				</form>
				
				<?php

				mysql_select_db($banco);

				if($sup){ // INICIO SELECT SUPS


								$tempo1 = date("D");
								$dia_da_semana=$tempo1;

								if($dia_da_semana=="Mon"){ $dia_da_semana="Segunda"; $inicio=0;  }
								if($dia_da_semana=="Tue"){ $dia_da_semana="Ter�a";   $inicio=-1; }
								if($dia_da_semana=="Wed"){ $dia_da_semana="Quarta";  $inicio=-2; }
								if($dia_da_semana=="Thu"){ $dia_da_semana="Quinta";  $inicio=-3; }
								if($dia_da_semana=="Fri"){ $dia_da_semana="Sexta";   $inicio=-4; }
								if($dia_da_semana=="Sat"){ $dia_da_semana="S�bado";  $inicio=-5; }
								if($dia_da_semana=="Sun"){ $dia_da_semana="Domingo"; $dia++; $inicio=0; $inicio2=0; } //CASO SEJA DOMINGO

								$tempo=date("Y-m-d");

								$tempo=explode("-",$tempo);

								$ano=$tempo[0];
								$mes=$tempo[1];
								$dia=$tempo[2];

								$dia_inicio=$dia;
								$desconto=13+$inicio;
								$dia_final=$dia_inicio+$desconto;

								$tempo_inicio=$ano."-".$mes."-".$dia_inicio." 08:00:00";






					if(($mes==1)||($mes==3)||($mes==5)||($mes==7)||($mes==8)||($mes==10)||($mes==12)){

						if($dia_final>=32){
							$mes++;
							if($mes==12){ $ano++; $mes=1; }
							if($mes<10){ $mes="0".$mes; }
							$marc=1;
							$dia_final=$dia_final-31;
							
						}
						if($marc!=1){
							if($dia_final<=0){
								$dia_final=31+$inicio;
								if($mes==3){ $dia_final=28+$inicio; } 
								$mes--;
								if($mes<10){ $mes="0".$mes; }
								$marc=1;
							}
						}

					}

					if($marc!=1){
						if(($mes==4)||($mes==6)||($mes==9)||($mes==11)){
							if($dia_final>=31){
								$marc=1;
								$dia_final=$dia_final-30;
							
							}
							if($marc!=1){
								if($dia_final<=0){
									$dia_final=30+$inicio;
									$mes--;
									if($mes<10){ $mes="0".$mes; }
									$marc=1;
								}
							}
						}
					}

					if($marc!=1){
						if($mes==2){
							if($dia_final>=29){
								$mes++;
								if($mes<10){ $mes="0".$mes; }
								$marc=1;
								$dia_final=$dia_final-28;
							}
							if($dia_final<=0){
								$dia_final=30+$inicio;
								$mes--;
								if($mes<10){ $mes="0".$mes; }
								$marc=1;
							}
						}
					}

					//$dia_final=$dia_final+$inicio;

					if($dia_final<10){ $dia_final="0".$dia_final; }

					$tempo_final=$ano."-".$mes."-".$dia_final." 21:00:00";

					$tempo_final2=$ano."-".$mes."-".$dia_final;


					// echo date("D",$tempo_final2);


			?>

				<table width="500" align="center">
					<tr align="center">	
						<td align="center" >
							<br>
							<table width="100%" align="center" >
								<tr align="center">	
									<td align="left">
										<font size=3 face="arial" color="#000000"><b><?php echo $L_MENSAGEM_17; ?> <?php echo $nome_sup; ?> <?php echo $L_MENSAGEM_18; ?> <?php echo $dia_final; echo("/"); echo $mes; echo("/"); echo $ano; ?>
									</td>
								</tr>
							</table>
							<br><br>

							<table border="0" width="100%" bgcolor="#9EC8FF">
								<tr align="center">	
									<td align="left">

										<BUTTON border="0" class="bordas" OnClick="AAA=window.open('index.php','_self');">
											<?php echo $L_SAIR; ?>
										</BUTTON>
									</td>
									<td align="right">

										<?php

										$matricula=$_POST['sup'];
	
										$sqlus1 = "SELECT * from reservas WHERE matricula = '$matricula' AND datatempo >= '$tempo_inicio' ORDER BY cod_sala, datatempo";
										$resultado1 = mysql_query($sqlus1) or die(mysql_error());
										$linha_us1=mysql_fetch_array($resultado1);

										if($linha_us1["matricula"]!=""){ // INICIO IF 001

										?>

										<BUTTON border="0" class="bordas" onclick="javascript: envapa();">
											<?php echo $L_APAGAR; ?>
										</BUTTON>

										<?php

										} // FIM IF 001

										?>
									</td>
								</tr>
							</table>

							<table border="0" width="100%" bgcolor="#9EC8FF">
							    <form method="post" name="apagar">
								<tr bgcolor="#EDF5FF">

									<td width="10%" ><font size=2 face="arial"><font color='#4682B4'>
										<b><center><?php echo $L_APAGAR; ?>?
									</td>
									<td  width="30%" align="left"><font size=2 face="arial"><font color='#4682B4'>
										<b><center><?php echo $L_SALA; ?>
									</td>
									<td  width="30%" align="left"><font size=2 face="arial"><font color='#4682B4'>
										<b><center><?php echo $L_DATA; ?>
									</td>
									<td  width="20%" align="left"><font size=2 face="arial"><font color='#4682B4'>
										<b><center><?php echo $L_HORA; ?>
									</td>
								</tr>

								<?php



								//echo $tempo_inicio;
								//echo $tempo_final;

								$datatempo98=date("Y-m-d");
								$datatempo98=date("Y-m-d");

								mysql_select_db($banco);
								$sqlus = "SELECT * from reservas WHERE matricula = '$sup' AND datatempo >= '$tempo_inicio' ORDER BY cod_sala, datatempo ";
								$resultado = mysql_query($sqlus) or die(mysql_error());
								$ci=0;
								while($linha_us=mysql_fetch_array($resultado)) { // INICIO WHILE_US

									$cod_sala=$linha_us["cod_sala"];
									$sqlus2 = "SELECT * FROM salas WHERE cod_sala = '$cod_sala' ";
									$resultado2 = mysql_query($sqlus2) or die(mysql_error());
									$linha_us2=mysql_fetch_array($resultado2);

								?>

								<tr bgcolor="#<?php if($ci==0){ echo("FFFFFF"); $ci=1; } else { echo("F5F5F5"); $ci=0; } ?>">
									<td><font size=1 face="arial">

										<input type="checkbox" name="apagarc[]" value="<?php echo $linha_us["datatempo"]; ?>/<?php echo $linha_us["matricula"]; ?>/<?php echo $linha_us["cod_sala"]; ?>">
										
									</td>
									<td align="left"><font size=1 face="arial">
										<center>

											<?php echo $linha_us2["nome_sala"]; ?>
																				</td>
									<td align="left"><font size=1 face="arial">
										<center>

											<?php

												$tempo4=$linha_us["datatempo"];
												$tempo4=explode(" ",$tempo4);
												$data=explode("-",$tempo4[0]);
												$hora=explode(":",$tempo4[1]);
												
												echo $data[2];
												echo("/");
												echo $data[1];
												echo("/");
												echo $data[0];

												$dia_da_semana=date("D",mktime(0, 0, 0, $data[1], $data[2], $data[0]));
	
												if($dia_da_semana=="Sun"){ echo(" ($L_DOMINGO)"); }
												if($dia_da_semana=="Mon"){ echo(" ($L_SEGUNDA)"); }
												if($dia_da_semana=="Tue"){ echo(" ($L_TERCA)"); }
												if($dia_da_semana=="Wed"){ echo(" ($L_QUARTA)"); }
												if($dia_da_semana=="Thu"){ echo(" ($L_QUINTA)"); }
												if($dia_da_semana=="Fri"){ echo(" ($L_SEXTA)"); }
												if($dia_da_semana=="Sat"){ echo(" ($L_SABADO)"); }


											?>


									</td>
									<td align="left"><font size=1 face="arial">
										<center>

											<?php echo $hora[0]; echo(":"); echo $hora[1]; ?>
									</td>

								</tr>

								<?php

								} // FIM WHILE_US
								
								?>
							   </form>
							</table>
							<br>
						</td>
					</tr>
				</table>

			<?php

				} // FIM SELECT SUPS

			} // FIM SALAS


			// -------------------------------------------------------------------------------


			$edsala=$_GET["edsala"];

			if($edsala){ // INICIO ED_SALA

				$nova=$_GET["nova"];

				if($nova=="sim"){

					echo("");

				} else {

				$sql = "SELECT * from salas WHERE cod_sala = $edsala";
				$result = mysql_query($sql) or die(mysql_error());
				$linha=mysql_fetch_array($result);

				}
	
			?>

				<table width="100%" align="center">
					<tr align="center">	
						<td align="center" class="bordas" bgcolor="#ffffff">
	
							<table width="100%" align="center" class="bordas" bgcolor="#483D8B">
								<tr align="center">	
									<td align="left">
										<font size=4 face="arial" color="#ffffff"><b><?php if($nova){ echo $L_NOVA_SALA; } else { echo $L_EDITAR_SALA; } ?>
									</td>
								</tr>
							</table>
							
							<table width="100%" align="center">
								<tr>	
									<td  align="right">
										<form name="edusersform" method="post" action="salas.php">
										<font face="arial,verdana" size="2"><?php echo $L_NOME; ?>: </font><br>
									</td>
									<td align="left">	
										
										<input type=text size="40" name="nome" value="<?php if($nova){ echo(""); } else { echo $linha["nome_sala"]; } ?>"><br>
										
									</td>
								</tr>
							</table>
							<table border="0">
								<tr>
									<td align="center">
										<center>
											<?php

											if($nova){
	
											?>
												<input border="0" class="bordas" type="Submit" name="edsala_nova" border=0 value="<?php echo $L_ADICIONAR; ?>"> 
	
											<?php
	
											} else {
	
											?>

												<input type="Hidden" name="cod_sala" border=0 value="<?php echo $edsala; ?>">
						
												<input border="0" class="bordas" type="Submit" name="edsala_env" border=0 value="<?php echo $L_ALTERAR; ?>">
												<br><br>
												
										
											<?php

											}	

											?>

										</form>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

			<?php
	
			} // FIM NOVO_SALA


			// ------------------------------------------------------------

	// ----------------------------------------------------------- 

		$edsala_env=$_POST["edsala_env"];

		if($edsala_env){ // INICIO SALA_ENV

			$nome=$_POST["nome"];
			$cod_sala=$_POST["cod_sala"];

			$sql = "UPDATE salas SET nome_sala='$nome',cod_sala='$cod_sala' WHERE cod_sala = $cod_sala";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('Sala Atualizada'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO ATUALIZADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} // FIM SALA_ENV	

		// CONTINUAR AQUI


		// -----------------------------------------------------------

		$edsala_nova=$_POST["edsala_nova"];

		if($edsala_nova){ // INICIO SALA_NOVA

			$nome=$_POST["nome"];

			$sql = "INSERT INTO salas (nome_sala) VALUES ('$nome')";

			if(mysql_query($sql)){

				echo ("<SCRIPT LANGUAGE=\"JavaScript\"> function tela(){ alert('Sala Adicionada'); window.navigate('salas.php?salas=sim'); } </SCRIPT> <BODY OnLoad=\"javascript:tela();\" > </body>");
			} else {
				echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO ADICIONADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
			}

		} // FIM SALA_NOVA	


		// ----------------------------------------------------------- USU�RIOS


		if($datatempo){ // INICIO APAGAR

			// $confirmado=$_GET["confirmado"];

			$matricula=$_GET["matricula"];
			$cod_sala=$_GET["cod_sala"];

			mysql_select_db($banco);

			$sql1 = "SELECT * from sups WHERE matsup = $matricula";
			$result1 = mysql_query($sql1) or die(mysql_error());
			$linha1=mysql_fetch_array($result1);

			$nome=$linha1["nome_sup"];

			/* if($confirmado!="ok"){

				?>

				<table bgcolor="#ffffff" align="center" width="100%" class="bordas">
					<tr>
						<td width="90%" align="center">
							<font face="arial" size="2"><center>
							<?php echo $L_MENSAGEM_19; ?> <b><?php echo $nome; ?></b> <?php echo $L_MENSAGEM_20; ?> <br><br><font size="3"><b> <?php echo $L_MENSAGEM_21; ?></b> <br><br>
							
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?apasala=<?php echo $apasala; ?>&confirmado=ok','_self');">
							<?php echo $L_SIM; ?>
							</BUTTON>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<BUTTON border="0" class="bordas" OnClick="AAA=window.open('salas.php?salas=sim','_self');">
							<?php echo $L_NAO; ?>
							</BUTTON>

						</td>
					</tr>
				</table>

				<?php

			} else {

			*/

				mysql_select_db($banco);

				$sql = "DELETE FROM reservas WHERE datatempo = '$datatempo' AND matricula = '$matricula' AND cod_sala = $cod_sala";
			
				if(mysql_query($sql)){

					?>
					<HTML>
					<HEAD>
						<SCRIPT LANGUAGE="JavaScript">
					
						function tela(){
		
							alert('Agendamento apagado!')
							form = document.verifica
							form.action = 'adm.php'
							form.submit();	
						}
						
						</SCRIPT>
					<HEAD>
					<BODY>
					
							<form name="verifica" method="post" action="adm.php">
								<input type="hidden" name="sup" border=0 value="<?php echo $matricula; ?>">
								<!-- <input type="hidden" name="nome" border=0 value="<?php echo $nome; ?>"> -->
							</form>

						<SCRIPT LANGUAGE="JavaScript">
							tela();
						</SCRIPT>
					</BODY>
					</HTML>				
					<?php

					exit();

				} else {
					echo ("<i><b><font face=\"arial,verdana\" size=\"-1\">SALA NAO APAGADA. CONTATE O SUPORTE LOCAL!!!</i><br> ERRO MySQL:</b> ". mysql_error());
				}
	

		} // FIM APAGAR
