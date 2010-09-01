
function conmutarLeido_NoLeido(m){

	
    if($(m).hasClassName('mensaje_0'))
    {
    	
        $(m).removeClassName('mensaje_0');
        $(m).addClassName('mensaje_1');
    }
    else
    {
    	
        $(m).removeClassName('mensaje_1');
        $(m).addClassName('mensaje_0');
    }

}

function conmutarContenido(m) {

    var cadena1 = 'texto_abreviado_'+m;
    var cadena2 = 'texto_completo_'+m;

    $(cadena1).toggle();
    $(cadena2).toggle();
}


