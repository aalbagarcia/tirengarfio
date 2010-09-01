<table>
  <tbody>
    <tr>
      <th>User1:</th>
      <td><?php echo $amigo_usuario->getuser1() ?></td>
    </tr>
    <tr>
      <th>User2:</th>
      <td><?php echo $amigo_usuario->getuser2() ?></td>
    </tr>
    <tr>
      <th>Estado:</th>
      <td><?php echo $amigo_usuario->getestado() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('amistad/edit?user1='.$amigo_usuario->getUser1().'&user2='.$amigo_usuario->getUser2()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('amistad/index') ?>">List</a>
