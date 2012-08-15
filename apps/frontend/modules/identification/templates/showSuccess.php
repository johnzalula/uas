<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $user_identification->getId() ?></td>
    </tr>
    <tr>
      <th>Identification:</th>
      <td><?php echo $user_identification->getIdentification() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $user_identification->getUserId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $user_identification->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $user_identification->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('identification/edit?id='.$user_identification->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('identification/index') ?>">List</a>
