<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Item Detail</h5>
      </div>
      <div class="modal-body">
        <table class="table table-stripe">
          <tr>
            <td>Name</td>
            <td>:</td>
            <td><?= $item['name']; ?></td>
          </tr>
          <tr>
            <td>Price</td>
            <td>:</td>
            <td><?= $item['price']; ?></td>
          </tr>
          <tr>
            <td>Category</td>
            <td>:</td>
            <td><?= $item['category']; ?></td>
          </tr>
          <tr>
            <td>Detail</td>
            <td>:</td>
            <td><?= $item['detail']; ?></td>
          </tr>
          <tr>
            <td>Created at</td>
            <td>:</td>
            <td><?= date('d/m/Y', strtotime($item['created_at'])); ?></td>
          </tr>
          <tr>
            <td>Updated at</td>
            <td>:</td>
            <td><?= date('d/m/Y', strtotime($item['updated_at'])); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>