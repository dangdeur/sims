<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.css" integrity="sha512-Ls19wNglxCDcP78k23k5MygHFHAamARZWDggNovFF3XM4nFTgJz28wBM3m76/bqxvaGWvLKwsv/toFoLqhF8Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <section class="container">

    <div class="row mt-5">
      <div class="col-md-8">

        <h1 class="text-gray-900"><?= $title; ?></h1>

        <!-- get data by ajax -->
        <div class="source-data"></div>

        <!-- Modal -->
        <div class="view-modal"></div>

      </div>
    </div>

  </section>



  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.js" integrity="sha512-Lbwer45RtGISU+efaUoil1EFYFliqkKOaZhUMXG8RoZZ5fdjpK4S/2khwZynw8vyItDeaRZ+IE6XdKA6XCsyxQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    })

    function source_data() {
      $.ajax({
        url: "/home/get_items",
        dataType: "json",
        success: function(res) {
          $(".source-data").html(res)
        }
      })
    }

    $(document).ready(function() {

      source_data()

      $(document).on("click", ".btn-add", function() {
        $.ajax({
          url: "/home/get_add_item_modal",
          dataType: "json",
          success: function(res) {
            $(".view-modal").html(res)
            $(".modal").modal("toggle")
          }
        })
      })

      $(document).on("submit", "#form-data", function(e) {
        e.preventDefault()

        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function(res) {
            if (res.status) {
              $(".modal").modal("toggle")
              Toast.fire({
                icon: 'success',
                title: 'Data berhasil ditambah'
              })
              source_data()
            } else {
              $.each(res.errors, function(key, value) {
                $('[name="' + key + '"]').addClass('is-invalid')
                $('[name="' + key + '"]').next().text(value)
                if (value == "") {
                  $('[name="' + key + '"]').removeClass('is-invalid')
                  $('[name="' + key + '"]').addClass('is-valid')
                }
              })
            }
          }
        })

        $("#form-data input").on("keyup", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data input").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data select").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
      })

      $(document).on("click", ".btn-detail", function() {
        var item_id = $(this).data("id")

        $.ajax({
          url: "/home/get_item",
          dataType: "json",
          data: {
            id: item_id
          },
          success: function(res) {
            $(".view-modal").html(res)
            $(".modal").modal("toggle")
          }
        })
      })

      $(document).on("click", ".btn-delete", function() {
        var item_id = $(this).data("id")

        $.ajax({
          url: "/home/get_delete_item_modal",
          dataType: "json",
          type: "post",
          data: {
            id: item_id
          },
          success: function(res) {
            $(".view-modal").html(res)
            $(".modal").modal("toggle")
          }
        })
      })

      $(document).on("submit", "#form-delete", function(e) {
        e.preventDefault()

        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function(res) {
            if (res.status) {
              $(".modal").modal("toggle")
              Toast.fire({
                icon: 'success',
                title: 'Data berhasil dihapus'
              })
              source_data()
            }
          }
        })
      })

      $(document).on("click", ".btn-update", function() {
        var item_id = $(this).data("id")

        $.ajax({
          url: "/home/get_update_item_modal",
          dataType: "json",
          type: "post",
          data: {
            id: item_id
          },
          success: function(res) {
            $(".view-modal").html(res)
            $(".modal").modal("toggle")
          }
        })
      })

      $(document).on("submit", "#form-update", function(e) {
        e.preventDefault()

        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function(res) {
            if (res.status) {
              $(".modal").modal("toggle")
              Toast.fire({
                icon: 'success',
                title: 'Data berhasil diperbarui'
              })
              source_data()
            } else {
              $.each(res.errors, function(key, value) {
                $('[name="' + key + '"]').addClass('is-invalid')
                $('[name="' + key + '"]').next().text(value)
                if (value == "") {
                  $('[name="' + key + '"]').removeClass('is-invalid')
                  $('[name="' + key + '"]').addClass('is-valid')
                }
              })
            }
          }
        })

        $("#form-update input").on("keyup", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-update input").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
      })


    })
  </script>
</body>

</html>