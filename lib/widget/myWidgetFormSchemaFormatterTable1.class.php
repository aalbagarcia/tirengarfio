<?php


      
class myWidgetFormSchemaFormatterTable1 extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<tr>
                               <td class=\"form_tabla_1_etiqueta\">%label%</td>
                               <td>%field%<td>
                        </tr>
                        <tr> 
                               <td class=\"form_tabla_1_celda_vacia\">&nbsp</td>
                               <td class=\"form_tabla_1_errores\">%error%%help%%hidden_fields%</td>
                        </tr>";
    //$errorRowFormat  = "<div class=\"errores_globales\">%errors%</div>";
    //$helpFormat      = '<br />%help%',
    //$decoratorFormat = "<table>\n  %content%</table>";
    
    
}