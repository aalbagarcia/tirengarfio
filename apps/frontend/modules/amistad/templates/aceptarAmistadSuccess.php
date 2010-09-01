<div class="texto_solicitud">

	<?php
	
	echo link_to($solicitud->getUser2()->getNombreApellidos(), 'miembros/show?id='.$solicitud->getUser2()->getId()),' forma parte de tu grupo de amigos desde ahora.'
	
	?>
	
</div>