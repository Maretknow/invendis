
        <h2 style="margin-top:0px">Puskesmas <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Puskesmas <?php echo form_error('nama_puskesmas') ?></label>
            <input type="text" class="form-control" name="nama_puskesmas" id="nama_puskesmas" placeholder="Nama Puskesmas" value="<?php echo $nama_puskesmas; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Keterangan Puskesmas <?php echo form_error('keterangan_puskesmas') ?></label>
            <textarea class="form-control" rows="3" name="keterangan_puskesmas" id="keterangan_puskesmas" placeholder="Keterangan Puskesmas"><?php echo $keterangan_puskesmas; ?></textarea>
        </div>
        <div class="form-group">
            <label for="varchar">Alamat Puskesmas <?php echo form_error('Alamat_puskesmas') ?></label>
            <textarea class="form-control" rows="3" name="alamat_puskesmas" id="alamat_puskesmas" placeholder="Alamat Puskesmas"><?php echo $alamat_puskesmas; ?></textarea>
        </div>
	    <input type="hidden" name="id_puskesmas" value="<?php echo $id_puskesmas; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('puskesmas') ?>" class="btn btn-default">Cancel</a>
	</form>