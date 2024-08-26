    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <h3>Rekap Kegiatan Tatap Muka</h3>
          <?php
        //   $option=[
        //     '01'=>'Januari',
        //     '02'=>'Februari',
        //     '03'=>'Maret',
        //     '04'=>'April',
        //     '05'=>'Mei',
        //     '06'=>'Juni',
        //     '07'=>'Juli',
        //     '08'=>'Agustus',
        //     '09'=>'September',
        //     '10'=>'Oktober',
        //     '11'=>'November',
        //     '12'=>'Desember'
        //   ];
            echo form_open('agendaguru/tatapmuka');
           
            //echo 'Agenda harian mengajar :';
            //$bln_sekarang=[date("m")];
            echo '<div class="row">';
            echo '<div class="col">';
            echo form_dropdown('mapel', $mapel,'' ,['class'=>'form-control']);
            echo '</div>';
            echo '<div class="col">';
            echo form_dropdown('rombel', $rombel,'' ,['class'=>'form-control']);
            echo '</div>';
            echo '</div>';
            echo '<br /><button class="w-100 btn btn-lg btn-primary" type="submit">Tampilkan</button>';
            echo form_close();

          ?>
         
        </div>
      </div>
    </div>
