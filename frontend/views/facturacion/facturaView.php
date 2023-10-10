<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "//www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    
    
    
    <!-- Fonts -->
    <!-- General CSS Files -->
 

   
</head>
<body>
<?php $styleCss = 'style'; ?>

<div style="width:100%;" >
<table width="100%"  >
    <tr>
        <td class="header-center" width="53%" style="width: 55%;">
        	<div class="logo" style="text-align:center; padding-bottom:10px;">
        		<img width="200px" src="images/electrohertz.jpg" alt="no-image" class="object-contain">
        	</div>
            <table width="98%" style="border:1px solid black; line-height:20px;" >
                <thead>
                <tr class="" style="line-height:20px;" >
                    <td style="padding:5px; padding-top:2px" class="vertical-align-top"  >
                        <strong class="from-font-size" style="font-size:14px; text-transform: uppercase; ">
                        REYES AVILA BETTY ALEXANDRA</strong><br>
                        <b>RUC:&nbsp;</b>0920136942001<br>
                        <b>Dir. Matriz:&nbsp;</b>Calle: PORTETE Número: 1109
Intersección: VILLAVICENCIO<br>
                        <b>Teléfono:&nbsp;</b>099 793 6550<br>
                        <b>Contribuyente especial:&nbsp;</b>No<br>
                        <b>Obligado a llevar contabilidad:&nbsp;</b>No<br>
                        <b>CONTRIBUYENTE RÉGIMEN RIMPE<br>
                    </td>
            
                </tr>
                </thead>
            </table>
        </td>
        <td width="47%" >
            <table  width="100%" style="border:1px solid;width: 100%; ">
                    <tr>
                
                        <td class="header-left" style="padding:5px; padding-top:2px">
                            <div class="invoice-number text-transform: uppercase"><b>FACTURA &nbsp;</b></div>
                        </td>
                        <td class="header-left" style="padding:5px; padding-top:2px">
                          001-100-<?= sprintf("%'.03d\n", $factura->nfactura); ?>
                            </td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px" colspan="2">
                            <b>Número de Autorización:</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px" colspan="2">
                         
                        <?= $factura->autorizacion ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px"><b>Fecha y Hora de Autorización:</b></td>
                        <td class="header-left" style="padding:5px; padding-top:2px"> <?= $factura->fechacreacion ?></td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px"><b>Ambiente:</b></td>
                        <td class="header-left" style="padding:5px; padding-top:2px">Producción</td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px"><b>Emisión:</b></td>
                        <td class="header-left" style="padding:5px; padding-top:2px">Normal</td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px; font-size: 12px;" colspan="2">
                            <b>CLAVE DE ACCESO:</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="header-left" style="padding:5px; padding-top:2px" colspan="2">
                            
                        <?= $factura->autorizacion ?>
                         
                        </td>
                        
                    </tr>
                </table>
        </td>
    </tr>
    
</table>


</div>
<br>


<table width="100%" style="border:1px solid; line-height: 15px; margin:0px; font-size:12px">
    <thead>
        <tr>
            <td colspan="2"   style="padding-left:5px;" width="70%">
                <b>Razón Social / Nombres y Apellidos:&nbsp;</b><?= $factura->nombre ?><br>
                
                
                
               
            </td>
            <td  style="padding-left:5px;" width="30%">
                <b>RUC:&nbsp;</b><?= $factura->ruc ?><br>
            </td>
        </tr>
 
        <tr>
         <td  colspan="2"  style="padding-left:5px; padding-bottom: 5px;" width="70%" >
            <b>Fecha Emisión:</b>&nbsp;<?= $factura->fecha ?>
            </td>
            <td  style="padding-left:5px;padding-bottom: 5px;" width="30%">
                <b>Guía de Remisión:&nbsp;</b>
            </td>
           
        </tr>
         
    </thead>
</table>
<table class="w-100"  style="font-size:10px; margin:0px;padding:0px;">
    <tr class="invoice-items"  style="  margin:0px;padding:0px;">
        <td colspan="2">
            <table class="d-items-table table-striped table-bordered" style="font-size:10px;">
                <thead>
                <tr style="font-size:10px;background:black; color:white">
                <th class="number-align"
                style="font-size:10px;border: 1px solid; padding: 5px; color:white">Cantidad</th>
                <th style="font-size:10px;border: 1px solid; padding: 5px; color:white">Producto</th>
                
                <th class="number-align"
                style="font-size:10px;border: 1px solid; padding: 5px; color:white; text-align:right;">Precio U.</th>
                <th class="number-align"
                style="font-size:10px;border: 1px solid; padding: 5px; color:white; text-align:right;">Precio T.</th>
                </tr>
                </thead>
                <tbody>
                    <?php  foreach ($factura->facturadetalle as $key => $value) { ?>
                        <tr>
                            <td style="font-size:10px;"><?= $value->cantidad ?></td>
                            <td style="font-size:10px;"><?= $value->narticulo ?></td>
                            
                            <td class="number-align" style="font-size:10px; text-align:right;"><b class="euroCurrency">$
                                    &nbsp;</b><?= ($value->idinventario!="3545")? number_format($value->valoru/1.12,2) : $value->valoru ?></td>
                           
                            <td class="number-align" style="font-size:10px; text-align:right;"><b class="euroCurrency">$
                                    &nbsp;</b><?=  ($value->idinventario!="3545")? $value->valort : $value->valort ; ?></td>
                        </tr>

                    <?php 
                            $subtotal+=$value->valort ;
                            $iva+=($value->idinventario=="3545")? 0: $value->valort*0.12061 ;
                        } 
                        
                        $total+=$subtotal+$iva;
                        
                    ?>
                        
                               
                        
                  
                </tbody>
            </table>
        </td>
    </tr>
    <br>
    <tr >
        <td width="100%" style="padding: 0px; line-height: 15px;">
            <table width="98%" style="font-size:10px;border: 1px solid; line-height: 15px;">
                <tr>
                    <td colspan="2"  ><p class="font-weight-bold mt-2 text-center" style="">Información Adicional</p>
                    </td>
                </tr>
                <tr>
                    <td width="30%" style="padding-left:5px; ">
                        <b>Teléfono</b>  
                    </td>
                    <td  width="70%" style="padding-left:5px; ">
                    <?= $factura->cliente->telefono ?>
                    </td>
                </tr>
                <tr>
                    <td  width="30%" style="padding-left:5px; ">
                        <b>Dirección</b>  
                    </td>
                    <td  width="70%" style="padding-left:5px; ">
                    <?= $factura->cliente->direccion ?>
                    </td>
                </tr>
                <tr>
                    <td  width="30%" style="padding-left:5px; ">
                        <b>Correo</b>  
                    </td>
                    <td  width="70%" style="padding-left:5px; ">
                        <?= $factura->cliente->correo ?>
                    </td>
                </tr>
                <tr>
                    <td  width="30%" style="padding-left:5px; ">
                        <b>Condición de pago</b>  
                    </td>
                    <td  width="70%" style="padding-left:5px; ">
                        SIN UTILIZACIÓN DEL SISTEMA FINANCIERO
                    </td>
                </tr>
 
                
            </table>    
        </td>
        <td width="35%" style="padding: 0px; margin:0; vertical-align:top;">
            <table width="100%"  style="font-size:10px; vertical-align:top;">
                <tr>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="font-weight-bold">SUBTOTAL:&nbsp;&nbsp;</td>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="text-nowrap">
                        <b class="euroCurrency">$</b>&nbsp;<?=number_format($subtotal,2)?>
                    </td>
                </tr>
                <tr>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="font-weight-bold">DESCUENTO:&nbsp;&nbsp;</td>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="text-nowrap">
                      
                          
                            &nbsp;&nbsp;0.00<span style="font-family: DejaVu Sans">&#37;</span>
                            
                       
                    </td>
                </tr>
                <tr>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="font-weight-bold">IVA:&nbsp;&nbsp;</td>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="text-nowrap">
                        <b class="euroCurrency">$</b>&nbsp;<?=number_format($iva,2)?>
                    </td>
                </tr>
                <tr>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="font-weight-bold">VALOR TOTAL:&nbsp;&nbsp;</td>
                    <td  style="border: 1px solid; text-align:right; padding-right:4px;" class="text-nowrap">
                        <b class="euroCurrency">$</b>&nbsp;<?=number_format($total,2)?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<br><br>

 
</body>
</html>