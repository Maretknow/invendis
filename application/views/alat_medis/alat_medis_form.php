
        <h2 style="margin-top:0px">Alat_medis <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Nama Alat <?php echo form_error('nama_alat') ?></label>
            <input type="text" class="form-control" name="nama_alat" id="nama_alat" placeholder="Nama Alat" value="<?php echo $nama_alat; ?>" />
        </div>
	    <div class="form-group">
            <label for="foto_alat">Foto Alat <?php echo form_error('foto_alat') ?></label>
            <input type="file" class="form-control" name="foto_alat"/>
            <input type="hidden" class="form-control" name="foto_alat" value="<?php echo $foto_alat; ?>" id="foto_alat" placeholder="Foto Alat"/>
        </div>
	    <div class="form-group">
            <label for="int">Jumlah <?php echo form_error('jumlah') ?></label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Alat Medis <?php echo form_error('tanggal_alat_medis') ?></label>
            
            <input type="date" class="form-control" name="tanggal_alat_medis" id="tanggal_alat_medis" placeholder="Tanggal Alat Medis" value="<?php echo $tanggal_alat_medis; ?>" />
        </div>

        <div class="form-group">
            <label for="int">Puskesmas <?php echo form_error('id_puskesmas') ?></label>
            <?php
            foreach ($query1->result_array()  as $row1) {
                $options1[$row1['id_puskesmas']]=$row1['nama_puskesmas'];
            }
         ?>
           <?php
            echo form_error('id_puskesmas');
            echo form_dropdown('id_puskesmas', $options1, '1', array('class' => 'form-control', 'id'=>'id_puskesmas'));
           ?>
        </div>
        
	    <div class="form-group">
            <label for="int">Id Jenis <?php echo form_error('id_jenis') ?></label>
            <?php
            foreach ($query->result_array()  as $row) {
                $options[$row['id_jenis']]=$row['nama_jenis'];
            }
         ?>
           <?php
            echo form_error('id_jenis');
            echo form_dropdown('id_jenis', $options, '1', array('class' => 'form-control', 'id'=>'id_jenis'));
           ?>
        </div>
	    <input type="hidden" name="id_alat" value="<?php echo $id_alat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('alat_medis') ?>" class="btn btn-default">Cancel</a>
	</form>