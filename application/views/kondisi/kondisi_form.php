
        <h2 style="margin-top:0px">Kondisi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Kondisi <?php echo form_error('nama_kondisi') ?></label>
            <input type="text" class="form-control" name="nama_kondisi" id="nama_kondisi" placeholder="Nama Kondisi" value="<?php echo $nama_kondisi; ?>" />
        </div>
	    <input type="hidden" name="id_kondisi" value="<?php echo $id_kondisi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kondisi') ?>" class="btn btn-default">Cancel</a>
	</form>
