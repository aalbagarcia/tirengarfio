<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mensaje->getid() ?></td>
    </tr>
    <tr>
      <th>Sf guard user:</th>
      <td><?php echo $mensaje->getusuario_id() ?></td>
    </tr>
    <tr>
      <th>Receptor:</th>
      <td><?php echo $mensaje->getreceptor() ?></td>
    </tr>
    <tr>
      <th>Tipo:</th>
      <td><?php echo $mensaje->gettipo() ?></td>
    </tr>
    <tr>
      <th>Contenido:</th>
      <td><?php echo $mensaje->getcontenido() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('mensaje/edit?id='.$mensaje->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('mensaje/index') ?>">List</a>
