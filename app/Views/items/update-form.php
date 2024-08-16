<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Item</h5>
      </div>
      <?= form_open('home/update_item', ['id' => 'form-update']); ?>
      <div class="modal-body">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= $item["id"]; ?>">

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="<?= $item["name"]; ?>">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" name="price" id="price" class="form-control" value="<?= $item["price"]; ?>">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="category">category</label>
          <select name="category" id="category" class="form-control">
            <?php foreach ($categories as $category) : ?>
              <?php if ($item["category"] == $category) : ?>
                <option value="<?= $category; ?>" selected><?= $category; ?></option>
              <?php else : ?>
                  <option value="<?= $category; ?>"><?= $category; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="3" class="form-control"><?= $item["detail"]; ?></textarea>
          <div class="invalid-feedback"></div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>

      <?= form_close(); ?>

    </div>
  </div>
</div>