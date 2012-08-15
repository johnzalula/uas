<h1>User identifications List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Identification</th>
      <th>User</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($user_identifications as $user_identification): ?>
    <tr>
      <td><a href="<?php echo url_for('identification/show?id='.$user_identification->getId()) ?>"><?php echo $user_identification->getId() ?></a></td>
      <td><?php echo $user_identification->getIdentification() ?></td>
      <td><?php echo $user_identification->getUserId() ?></td>
      <td><?php echo $user_identification->getCreatedAt() ?></td>
      <td><?php echo $user_identification->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('identification/new') ?>">New</a>
