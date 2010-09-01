<?php

      
class myWidgetFormSchemaFormatterTable2 extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<tr>
                               <td class=\"etiqueta_arriba_derecha\">%label%</td>
                               <td>%field%<td>
                        </tr>
                        <tr> 
                               <td class=\"celda_vacia\">&nbsp</td>
                               <td>%error%%help%%hidden_fields%</td>
                        </tr>";
    //$errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    //$helpFormat      = '<br />%help%',
    //$decoratorFormat = "<table>\n  %content%</table>";
    
    
}