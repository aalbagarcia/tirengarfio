<div class="texto_solicitud">
<?php
echo "Has rechazado la solicitud de amistad de ".link_to($solicitud->getUser2()->getNombreApellidos() ,'miembros/show?id='.$solicitud->getUser2()->getId());



?>
</div>