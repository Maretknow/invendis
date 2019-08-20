
        <h2 style="margin-top:0px">Alat_medis List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('alat_medis/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('alat_medis/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('alat_medis'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Alat</th>
		<th>Foto Alat</th>
		<th>Jumlah</th>
		<th>Tanggal Alat Medis</th>
		<th>Jenis</th>
        <th>Puskesmas</th>
		<th>Action</th>
            </tr><?php
            foreach ($alat_medis_data as $alat_medis)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $alat_medis->nama_alat ?></td>
			<!-- <td><a href="#" class="pop"><img width="50" height="50" src="<?php echo base_url(); ?>upload/foto_alat/<?php //echo $alat_medis->foto_alat ?>"></a></td> -->
            <td><a href="#" class="pop"><img width="50" height="50" src="https://invendis.s3.amazonaws.com/<?php  $picaalat = str_replace(' ', '+', $alat_medis->foto_alat); echo $picaalat ?>"></a></td>
			<td><?php echo $alat_medis->jumlah ?></td>
			<td><?php echo $alat_medis->tanggal_alat_medis ?></td>
			<td><?php echo $alat_medis->nama_jenis ?></td>
            <td><?php echo $alat_medis->nama_puskesmas ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('alat_medis/read/'.$alat_medis->id_alat),'Read'); 
				echo ' | '; 
				echo anchor(site_url('alat_medis/update/'.$alat_medis->id_alat),'Update'); 
				echo ' | '; 
				echo anchor(site_url('alat_medis/delete/'.$alat_medis->id_alat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('alat_medis/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('alat_medis/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

                <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>


