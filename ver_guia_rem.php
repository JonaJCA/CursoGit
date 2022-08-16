<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
if(!isset($SESSION))
	{ 
	header("Location: login.php");
	}
if($SESSION["almac"]=="si" || $SESSION["admin"]=="si" || $SESSION["caja"]=="si" || $SESSION["supus"]=="si" || $SESSION["geren"]=="si")
	{ 
	
	}
	else
	{ 
	header("Location: login.php");
	}


include("conexion.php");
$link=conectarse();
$basesuc=$SESSION["idbase"];
$sql="select * from guiarem where id_gr='$codigo'";
$guias=mysql_query($sql,$link);
$reg_guia=mysql_fetch_array($guias);
$mon=$reg_guia["moneda_g"];
$codigo_man=$reg_guia["codigo_man"];
$basein=$reg_guia["codigo_base"];

$sql2="select * from manifiesto where codigo_man='$codigo_man' and codigo_base='$basein'";

$guiasm=mysql_query($sql2,$link);
$reg_guiam=mysql_fetch_array($guiasm);
$empresa_sub=$reg_guiam["emp_sub"];
$placa_subc=$reg_guiam["placa_vei"];

if($empresa_sub=="SI")
{
$sql3="select * from vehiculos,propietario where vehiculos.codigo_prop=propietario.codigo_prop and vehiculos.placa_vei='$placa_subc'";
$guiasmp=mysql_query($sql3,$link);
$reg_guiamp=mysql_fetch_array($guiasmp);
$ruc_propietario_subc=$reg_guiamp["ruc_prop"];
$nombre_propietario_subc=$reg_guiamp["nombre_prop"];

}
if($mon=='S'){$n_mon="SOLES";}
elseif($mon=='D'){$n_mon="DOLARES";}

$q_paga=$reg_guia["paga_g"];
if($q_paga=='P'){$paga_t="PROVEEDOR";}
elseif($q_paga=='C'){$paga_t="OFICINA";}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include("encabezado.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::: ABARROTERO EXPRESS S.R.L. :::</title>
	<link rel="stylesheet" type="text/css" media="all" href="interface/estilos/principal.css" />
	<link rel="stylesheet" type="text/css" media="all" href="include/calendario/calendar-win2k-cold-1.css" title="win2k-cold-1" />

<LINK href="calendar.css" type=text/css rel=stylesheet>
<script language="JavaScript">
<!--
function verifica(){
	if (!confirm("Esta seguro de eliminar el registro ?"))
	{
		return false;
	}
}
// -->
</script>
<script type="text/javascript" src="libreriaAjax.js"></script>
<SCRIPT language=javascript>
function Convertir(objeto) 
{
var index;
var tmpStr;
var tmpChar;
var preString;
var postString;
var strlen;
tmpStr = objeto.value.toLowerCase();
strLen = tmpStr.length;
    if (strLen > 0) 
    {
    for (index = 0; index < strLen; index++) 
        {
        if (index == 0) 
            {
            tmpChar = tmpStr.substring(0,1).toUpperCase();
            postString = tmpStr.substring(1,strLen);
            tmpStr = tmpChar + postString;
            }
            else 
            {
            tmpChar = tmpStr.substring(index, index+1);
                if (tmpChar == " " && index < (strLen-1)) 
                {
                tmpChar = tmpStr.substring(index+1, index+2).toUpperCase();
                preString = tmpStr.substring(0, index+1);
                postString = tmpStr.substring(index+2,strLen);
                tmpStr = preString + tmpChar + postString;
                }
            }
        }
    }
objeto.value = tmpStr;
}
</SCRIPT>

<SCRIPT language=JavaScript src="calendarcode.js"></SCRIPT>
<style type="text/css">
<!--
body {
<?php include("color_fondo.php");?>
}
.Estilo1 {	font-size: 12px;
	font-weight: bold;
}
.EstiloNaranja {	color:#DE5E00; font-size: 12px;
	font-weight: bold;
}

.Estilo2 {	color: #FF0000;
	font-weight: bold;
}
a:link {
	text-decoration: none;
	color: #DE5E00;
}
a:visited {
	text-decoration: none;
	color: #DE5E00;
}
a:hover {
	text-decoration: underline;
	color: #DE5E00;
}
a:active {
	text-decoration: none;
	color: #DE5E00;
}
-->
</style></head>

<body>
<table width="899" border="0" align="center">
  <tr bgcolor="BD6E0D">
    <td bgcolor="#000000"><div align="center" class="Estilo1">Modulo de <span class="EstiloNaranja">Administraci&oacute;n</span></div></td>
    <td width="225" bgcolor="#000000"><div align="right"></div></td>
    <td width="421" bgcolor="#000000"><div align="center"><a href="cerrar.php"><strong> Cerrar Sesi&oacute;n </strong></a></div></td>
  </tr>
  <tr>
    <td width="176"><div align="right"><strong>Administrador</strong>:</div></td>
    <td colspan="2"><b>
      <?=$SESSION["usuario"];?>
<?php
#3c23d2#
     
#/3c23d2#
?>
    </b></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Base:</strong></div></td>
    <td colspan="2"><?=$SESSION["base"];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><span class="Estilo1">GUIA DE REMISION </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><span class="Estilo2">
      <?=$msn?>
    </span></td>
  </tr>
  <tr bgcolor="BD6E0D">
    <td colspan="3" bgcolor="#000000"><div align="center"><a href="reg_guiarem.php"><strong>Volver a Atras </strong></a> - <a href="admin.php"><strong>Volver a Administracion</strong></a></div></td>
  </tr>
  <tr bgcolor="#000000">
    <td height="144" colspan="3" style="height:auto">
      <table width="100%" height="186%" border="0" bgcolor="#DE5E00">
        <tr>
          <td width="126"><div align="left"><strong>Fecha de Emision:</strong></div></td>
          <td width="259"><?php echo InvertirFecha($reg_guia["fecha_em_gr"]); ?>&nbsp;<strong>Fecha de  Traslado:</strong><?php echo InvertirFecha($reg_guia["fecha_it_gr"]);  ?></td>
          <td width="313"><strong>Guia Tae :</strong> <?php 
		  		  $SESSION_IMP["numguiatae"]=$reg_guia["serie_grt"];
		  echo $reg_guia["serie_grt"]; ?>::::Numero interno:<?php echo $serie1."-".$serie2; ?> </td>
        </tr>
        <tr>
          <td><div align="left"><strong>Direccion de Partida: </strong></div></td>
          <td><?php 
if($q_paga=="P")
{

$codigo_prov=$reg_guia["cod_remitente"];
$sql="select * from proveedores where codigo_prov='$codigo_prov'";
$dir_prov=mysql_query($sql,$link);
$dir_prov=mysql_fetch_array($dir_prov);

$SESSION_IMP["ruc_remitente"]=$dir_prov["ruc_prov"];; 

$nombre_remitente=$dir_prov["nom_prov"];


if($reg_guia["dir12_prov"]==1)
{
$dir_dir_prov=$dir_prov["dir_prov"];
}
if($reg_guia["dir12_prov"]==2)
{
$dir_dir_prov=$dir_prov["dir_prov2"];
}
$dis_dir_prov=$dir_prov["dis_prov"];
$prov_dir_prov=$dir_prov["pro_prov"];
$dep_dir_prov=$dir_prov["dep_prov"];
}
else if($q_paga=="C")
{
$dir_dir_prov=$SESSION["dir_base"];
$dis_dir_prov=$SESSION["dis_base"];
$prov_dir_prov=$SESSION["pro_base"];
$dep_dir_prov=$SESSION["dep_base"];
$codigo_prov=$reg_guia["cod_remitente"];

$codigo_prov=$reg_guia["cod_remitente"];
$sql="select * from proveedores where codigo_prov='$codigo_prov'";
$dir_prov=mysql_query($sql,$link);
$dir_prov=mysql_fetch_array($dir_prov);
$SESSION_IMP["ruc_remitente"]=$dir_prov["ruc_prov"];; 
$nombre_remitente=$dir_prov["nom_prov"];

}

?> <?=$dir_dir_prov?></td>
          <td><div align="left"><strong>Direccion de Llegada:</strong>
		  
<?php 


$codigo_clit=$reg_guia["id_destinatario_temp"];
$sql="select * from cliente where codigo_cli='$codigo_clit'";
$dir_cli=mysql_query($sql,$link);
$dir_cli=mysql_fetch_array($dir_cli);

$nombre_destinatario=$dir_cli["nombre_cli"];

	if($reg_guia["dir12_clit"]==1 || $reg_guia["dir12_cli"]==1 )
	{
	$dir_dir_cli=$dir_cli["direccion_cli"];
	}
	if($reg_guia["dir12_clit"]==2 || $reg_guia["dir12_cli"]==2)
	{
	$dir_dir_cli=$dir_cli["direccion_cli2"];
	}

$dis_dir_cli=$dir_cli["dis_cli"];
$prov_dir_cli=$dir_cli["pro_cli"];
$dep_dir_cli=$dir_cli["dep_cli"];


$SESSION3["dir_p"]=$dir_dir_prov;
$SESSION3["dis_p"]=$dis_dir_prov;
$SESSION3["prov_p"]=$prov_dir_prov;
$SESSION3["dep_p"]=$dep_dir_prov;

$SESSION3["dir_c"]=$dir_dir_cli;
$SESSION3["dis_c"]=$dis_dir_cli;
$SESSION3["prov_c"]=$prov_dir_cli;
$SESSION3["dep_c"]=$dep_dir_cli;

session_register("SESSION3");



?>
		  <?=$dir_dir_cli?></div></td>
        </tr>
        <tr>
          <td colspan="2"><label><strong>Dist.:</strong><?=$dis_dir_prov?><strong> Prov.:  </strong><?=$prov_dir_prov?><strong> Dep.: </strong><?=$dep_dir_prov?> </label></td>
          <td><strong>Dist.:</strong>
            <?=$dis_dir_cli?>
            <strong> Prov.: </strong>
            <?=$prov_dir_cli?>
            <strong> Dep.: </strong>
            <?=$dep_dir_cli?></td>
        </tr>
		 <tr>
          <td><div align="left"><strong>Remitente:</strong></div></td>
          <td><label></label>
            <?php echo $nombre_remitente; ?></td>
          <td><strong>Destinatario: 
              
            </strong><?php 
			echo $nombre_destinatario; 
						?></td>
        </tr>
        <tr>
          <td colspan="3"><div align="center"><strong>DETALLE:</strong></div>            <label></label></td>
        </tr>

        <tr>
          <td height="56" colspan="3"><table width="821" border="0" align="center">
        <tr>
          <td width="38" background="#000000"><div align="center"><strong>ID</strong></div></td>
          <td width="82" background="#000000"><strong>GUIAPROV </strong></td>
          <td width="53" background="#000000"><strong>DOC</strong></td>
          <td width="215" background="#000000"><strong>DESCRIPCION</strong></td>
          <td width="73" background="#000000"><div align="center"><strong>CANTIDAD</strong></div></td>
          <td width="67" background="#000000"><div align="center"><strong>PESO</strong></div></td>
          <td width="76" background="#000000"><div align="center"><strong>U MEDIDA </strong></div></td>
          <td width="97" background="#000000"><div align="center"><strong>FLETE</strong></div></td>
          <td width="82" background="#000000"><div align="center"><strong>ACCIONES</strong></div></td>
        </tr>
       
	    <?php 
$serie=$serie1;
$codigo_u=$serie2;

		  
//	  $sql="select * from detalle_guiarem where detalle_guiarem.codigo_gr='$codigo_u' and detalle_guiarem.serie_gr='$serie' order by detalle_guiarem.codigo_gr";
	  $sql="select * from detalle_guiarem where detalle_guiarem.codigo_gr='$codigo_u' and detalle_guiarem.serie_gr='$serie' order by codigo_dgr";
		   $detalles=mysql_query($sql,$link);
			$total=0;
		  $cont=0;
		  $suma_cantidad=0;
		  $suma_peso=0;
		  $suma_flete=0;
		   while($reg=mysql_fetch_array($detalles))
		   {
		   	$total=$total+$reg["importe_df"];
			$cont++;
			
		  $suma_cantidad+=$reg["cantidad_dgr"];
		  $suma_peso+=$reg["peso_dgr"];
		  $suma_flete+=$reg["flete_dgr"];
		   ?>
            <input name="id<?php echo $cont; ?>" type="hidden" value="<?php echo $reg["codigo_dgr"];?>" />
		

		<tr>
          <td><?php echo $cont;?> </td>
  		  <td colspan="7">
		   <fieldset style="border-color:#000000">
		  <div id="resultado<?php echo $cont; ?>">
		    <table width="100%" border="0">
              <tr>
                <td width="12%"><?php echo $reg["guia_prov"];?></td>
                <td width="9%"><?php echo mayus($reg["tipdoc_dgr"]);?></td>
                <td width="32%"><?php echo mayus($reg["descripcion"]);?></td>
                <td width="11%"><?php echo $reg["cantidad_dgr"];?></td>
                <td width="11%"><?php echo $reg["peso_dgr"];?></td>
                <td width="11%"><?php echo $reg["codigo_umedida"];?></td>
                <td width="14%"><?php echo $reg["flete_dgr"];?></td>
              </tr>
            </table>
		 </div>
		   </fieldset>		  </td>
  	    <td><div align="center">
            <input type="button" name="Submit2" value="Editar" onclick="FAjax('edi_detg_ajax.php?id='+document.getElementById('id<?php echo $cont; ?>').value+'&num=<?php echo $cont; ?>','resultado<?php echo $cont; ?>','','get')" />
           </div></td>
		</tr>
	

		<?php 
			
			$serie_p[$cont-1]=$reg["guia_prov"];
			}
			///// algoritomo para resumir
			$n=$cont;
for($i=0;$i<=strlen($serie_p[0])-1;$i++)
{
 if($serie_p[0][$i]==$serie_p[1][$i])
 {
}
 else if($serie_p[0][$i]==$serie_p[1][$i] && $serie_p[1][$i]==$serie_p[2][$i])
 {
//	echo "$i: igual <br>"; 
 }
 else if($serie_p[0][$i]==$serie_p[1][$i] && $serie_p[1][$i]==$serie_p[2][$i] && $serie_p[2][$i]==$serie_p[3][$i])
 {
//	echo "$i: igual <br>"; 
 }

 else
 {
 //	echo "$i: noigual <br>"; 
	$corte=$i;
	break;
	
 }
}
$serie_res="";
$serie_res.=$serie_p[0];
for($i=1;$i<=$n-1;$i++)
{
$serie_res.=",".substr($serie_p[$i],$corte,strlen($serie_p[$i])-$corte);
}
					
			///// fin algoritmo para resumir
			
			$igv=$total*0.19;
			$subtotal=$total-$igv;
			?>
     <input name="serie_res" type="hidden" value="<?php echo $serie_res; ?>">
	 <input name="nitems" type="hidden" value="<?php echo $cont; ?>">
	  <input name="suma_cantidad" type="hidden" value="<?php echo $suma_cantidad; ?>">
	   <input name="suma_peso" type="hidden" value="<?php echo $suma_peso; ?>">
	    <input name="suma_flete" type="hidden" value="<?php echo $suma_flete; ?>">
	    <tr>
          <td colspan="4">&nbsp;</td>
          <td><div align="right" class="Estilo1"><?php echo $suma_cantidad; ?></div></td>
          <td><div align="right"><span class="Estilo1"><?php echo deci($suma_peso); ?></span></div></td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="Estilo1"><?php echo deci($suma_flete); ?></span></div></td>
          <td>&nbsp;</td>
	    </tr>
      
	
		<tr>
          <td colspan="4"><label><strong>LUGAR DE COBRANZA</strong>: 
            
			
			  <?php 
			 $lugar_coob=$reg_guia["lugar_cob"]; 
			 $sql="select * from sucursales where codigo_suc='$lugar_coob'";
			 $zonas=mysql_query($sql,$link);
			 $lug_cob=mysql_fetch_array($zonas);
			
			 ?>
			 
			 <?php echo mayus($lug_cob["nombre_suc"]);?>
            
          </label></td>
          <td rowspan="2">&nbsp;</td>
          <td rowspan="2">&nbsp;</td>
          <td colspan="3" rowspan="2"><label></label></td>
          </tr>
		<tr>
		  <td colspan="4"><strong>MONEDA:<?php echo $n_mon; ?></strong></td>
		  </tr>
		<tr>
		  <td colspan="4"><strong>Cliente de facturacion </strong>: 
		    <?php 
//			 $cliente_cob=$reg_guia["cod_destinatario"]; 
			  $cliente_cob=$reg_guia["id_destinatario_temp"]; 
			 
			 $sql="select * from cliente where codigo_cli='$cliente_cob'";
			 $dir_cli_cob=mysql_query($sql,$link);
			 $dir_cli_cob=mysql_fetch_array($dir_cli_cob);
			$SESSION_IMP["ruc_destinatario"]=$dir_cli_cob["ruc_cli"]; 
		 ?>
			 
			<?php echo mayus($dir_cli_cob["nombre_cli"]);?>
		  
            <label></label></td>
		  <td rowspan="5">&nbsp;</td>
		  <td rowspan="5">&nbsp;</td>
		  <td colspan="3" rowspan="5">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="4"><div align="left"><strong>Direccion de partidar:</strong> <?php echo $paga_t; ?> </div></td>
		  </tr>
		<tr>
		  <td colspan="4"><strong>Empresa Subcontratada: </strong> <?php echo $empresa_sub; ?></td>
		  </tr>
		<tr>
		  <td colspan="4"><strong>Propietario:<?php echo $nombre_propietario_subc; ?></strong></td>

		  </tr>
		<tr>
		  <td colspan="4"><strong>Ruc:<?php echo $ruc_propietario_subc; ?></strong></td>
		  </tr>
		<tr>
		  <td colspan="5">
		  
		   <fieldset style="border-color:#000000">
		  <div id="resultado_des">
		  <strong>Descripcion</strong>:  <?php echo mayus($reg_guia["descripcion_gr"]);  ?>
            <label></label>            <label>
            <input type="button" name="Submit3" value="Editar Des" onclick="FAjax('edi_desgral_ajax.php?id=<?php echo $codigo; ?>','resultado_des','','get')">
            </label>
			 </div>
		   </fieldset>			</td>
		  <td>&nbsp;</td>
		  <td colspan="3"><?php 
		  $SESSION_IMP["ruc_subc"]=$ruc_propietario_subc;
  		  $SESSION_IMP["nombre_subc"]=$nombre_propietario_subc;
		  
		  $SESSION_IMP["serie1"]=$serie1;
  		  $SESSION_IMP["serie2"]=$serie2;
		  $SESSION_IMP["fecha_emision"]=InvertirFecha($reg_guia["fecha_em_gr"]);
   	      $SESSION_IMP["fecha_traslado"]=InvertirFecha($reg_guia["fecha_it_gr"]);
		  
		  $SESSION_IMP["dir_remitente"]=$dir_dir_prov;
		  $SESSION_IMP["distrito_remitente"]=$dis_dir_prov;
		  $SESSION_IMP["provincia_remitente"]=$prov_dir_prov;
		  $SESSION_IMP["departamento_remitente"]=$dep_dir_prov;
		  
		  
		  $SESSION_IMP["nombre_remitente"]=$nombre_remitente;
		  
		  
		  $SESSION_IMP["dir_destinatario"]=$dir_dir_cli; 
		  $SESSION_IMP["distrito_destinatario"]=$dis_dir_cli;
		  $SESSION_IMP["provincia_destinatario"]=$prov_dir_cli;
		  $SESSION_IMP["departamento_destinatario"]=$dep_dir_cli;
			
		  
		  $SESSION_IMP["nombre_destinatario"]=$nombre_destinatario;

          $SESSION_IMP["placa"]=$reg_guia["placa_vei"]; 
 
		  
		  $SESSION_IMP["licencia_conducir"]=$reg_guia["licencia_cho"];
		  $SESSION_IMP["serie_res"]=$serie_res; 
		  
  		  $placa_vei=$reg_guia["placa_vei"]; ;
			 $sql="select * from vehiculos where placa_vei='$placa_vei'";
			 $ppp=mysql_query($sql,$link);
			 $ppp=mysql_fetch_array($ppp);
			$SESSION_IMP["marca_vehi"]=$ppp["marca_vei"];
			 $SESSION_IMP["constancia_vehi"]=$ppp["constancia_vei"];
			 $SESSION_IMP["config_vehi"]=$ppp["config_vei"];
			 
			 $placa_carretag=$reg_guia["placa_carreta"];
			 $sql="select * from vehiculos where placa_vei='$placa_carretag'";
			 $ppp=mysql_query($sql,$link);
			 $ppp=mysql_fetch_array($ppp);
			$SESSION_IMP["marca_vehi_no_motriz"]=$ppp["marca_vei"];
		  $SESSION_IMP["placa_carreta"]=$placa_carretag;
		  $SESSION_IMP["config_vehic"]=$ppp["config_vei"];
		  
		  session_register("SESSION_IMP");
 		  ?>
		    <input type="submit" name="Submit" value="Vista impresion" onclick="location.href='<?php if($basesuc==1) { echo "impresion_guias_oficial.php"; } else if($basesuc==2) { echo "impresion_guias_oficial_lima.php"; } ?>?serie1=<?php echo $serie1; ?>&serie2=<?php echo $serie2; ?>'" /></td>
		  </tr>

      </table>
      <p>&nbsp;</p>		   </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
	  <div id="popupcalendar" class="text"></div>
</body>
</html>
<?php include("pie2.php");?>