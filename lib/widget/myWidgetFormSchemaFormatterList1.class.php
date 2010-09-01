<?php

      
class myWidgetFormSchemaFormatterList1 extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"form_lista_1_etiqueta\">
                            %label%
                        </div>
                        <div class=\"form_lista_1_campo\">
                            %field%
                        </div>
                        <div class=\"form_lista_1_errores\">
                            %error%%help%%hidden_fields%
                        </div>";
    //$errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    //$helpFormat      = '<br />%help%',
    
    
}