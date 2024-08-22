<div class="container">
  <?php 
  //$nama_rombel=array();
  for ($a=0;$a<count($rombel);$a++)
  {
    $nama_rombel[$rombel[$a]['rombel']]=$rombel[$a]['rombel'];
  }
  //echo form_open("form_terlambat",['class'=>'row g-3']);
  echo '<div class="row g-3">';
  echo '<div class="col-auto">';
  echo form_dropdown('rombel', $nama_rombel,'', $att=['class'=>'form-select','id'=>'rombel']); 
  echo '</div>';
  echo '<div class="col-auto">';
  //echo form_submit('tampilkan', 'Tampilkan',['class'=>'form-control']);
  echo '</div>';
  echo '</div>';
  ?>
  <div id="tampil"></div>





</div>

<?php
//echo form_close();
?> 

 <script type="text/javascript">
    $(document).ready(function () {
        $('#rombel').change(function () {

            var rombel = $('#rombel').val(); // <-- change this line
            console.log(rombel);

            $.ajax({
                url: "<?php base_url('tampil_siswa'); ?> ",
                // async: false,
                type: "POST",
                // data: "rombel="+rombel,
                data:{"rombel":rombel},
                contentType: "application/json",
                dataType: "json",

                success: function(result) {
                  var data = json.parse(result);
                    $('#tampil').html(data.nis);
                }
            })
        });
    });


    function fetchStateData(countryId) {
            $.ajax({
                url: "<?php echo site_url("state") ?>",
                method: "POST",
                data: {
                    cId: countryId
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let output = "<option>select state</option>";
                    for (let row in data) {
                        output += `<option value="${data[row].id}">${data[row].name}</option>`;
                        // console.log(data[row].id);
                        // console.log(data[row].name);
                    }
                    document.querySelector("#stateID").innerHTML = output;
                    // console.log(result);
                }
            });
        }
</script>
