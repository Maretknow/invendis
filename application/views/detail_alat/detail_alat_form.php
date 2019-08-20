
        <h2 style="margin-top:0px">Detail_alat <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Alat <?php echo form_error('id_alat') ?></label>
            <?php
            foreach ($query->result_array()  as $row) {
                $options[$row['id_alat']]=$row['nama_alat'];
            }
         ?>
           <?php
            echo form_error('id_alat');
            echo form_dropdown('id_alat', $options, '1', array('class' => 'form-control', 'id'=>'id_alat'));
           ?>
        </div>
	    <div class="form-group">
            <label for="int">Id Kondisi <?php echo form_error('id_kondisi') ?></label>
            <?php
            foreach ($query2->result_array()  as $row) {
                $optionskondisi[$row['id_kondisi']]=$row['nama_kondisi'];
            }
         ?>
           <?php
            echo form_error('id_kondisi');
            echo form_dropdown('id_kondisi', $optionskondisi, '1', array('class' => 'form-control', 'id'=>'id_kondisi'));
           ?>
        </div>
	    <div class="form-group">
            <label for="int">Jumlah Kondisi <?php echo form_error('jumlah_kondisi') ?></label>
            <input type="text" class="form-control" name="jumlah_kondisi" id="jumlah_kondisi" placeholder="Jumlah Kondisi" value="<?php echo $jumlah_kondisi; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Kondisi <?php echo form_error('tanggal_kondisi') ?></label>
            <input type="date" class="form-control" name="tanggal_kondisi" id="tanggal_kondisi" placeholder="Tanggal Kondisi" value="<?php echo $tanggal_kondisi; ?>" />
        </div>
	    <input type="hidden" name="id_detail_alat" value="<?php echo $id_detail_alat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('detail_alat') ?>" class="btn btn-default">Cancel</a>
	</form>
