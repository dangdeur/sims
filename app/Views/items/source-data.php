<button type="button" class="btn btn-sm btn-primary btn-add">Add</button>

<table class="table table-stripe">
  <thead>
    <th>No.</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Actions</th>
  </thead>
  <tbody>
    <?php foreach ($items as $key => $item) : ?>
      <tr>
        <td><?= $key + 1; ?></td>
        <td><?= $item['name']; ?></td>
        <td><?= $item['price']; ?></td>
        <td><?= $item['category']; ?></td>
        <td>
          <button type="button" class="btn btn-sm btn-info btn-detail" data-id="<?= $item['id']; ?>">Detail</button>
          <button type="button" class="btn btn-sm btn-success btn-update" data-id="<?= $item['id']; ?>">Update</button>
          <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?= $item['id']; ?>">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>