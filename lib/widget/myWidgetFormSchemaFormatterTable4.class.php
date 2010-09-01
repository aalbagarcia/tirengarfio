<?php

      
class myWidgetFormSchemaFormatterTable4 extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat  = "   
                      %label%    %field%
                   
                  ",
    //$errorRowFormat  = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
    //$helpFormat      = '<br />%help%',
    $decoratorFormat = "%content%";
    
    
}