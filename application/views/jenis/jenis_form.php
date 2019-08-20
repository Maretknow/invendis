
        <h2 style="margin-top:0px">Jenis <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Jenis <?php echo form_error('nama_jenis') ?></label>
            <input type="text" class="form-control" name="nama_jenis" id="nama_jenis" placeholder="Nama Jenis" value="<?php echo $nama_jenis; ?>" />
        </div>
	    <input type="hidden" name="id_jenis" value="<?php echo $id_jenis; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis') ?>" class="btn btn-default">Cancel</a>
	</form>
