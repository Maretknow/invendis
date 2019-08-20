
        <h2 style="margin-top:0px">Detail_alat List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('detail_alat/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('detail_alat/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('detail_alat'); ?>" class="btn btn-default">Reset</a>
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
		<th>Alat</th>
		<th>Kondisi</th>
		<th>Jumlah Kondisi</th>
		<th>Tanggal Kondisi</th>
		<th>Action</th>
            </tr><?php
            foreach ($detail_alat_data as $detail_alat)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $detail_alat->nama_alat ?></td>
			<td><?php echo $detail_alat->nama_kondisi ?></td>
			<td><?php echo $detail_alat->jumlah_kondisi ?></td>
			<td><?php echo $detail_alat->tanggal_kondisi ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('detail_alat/read/'.$detail_alat->id_detail_alat),'Read'); 
				echo ' | '; 
				echo anchor(site_url('detail_alat/update/'.$detail_alat->id_detail_alat),'Update'); 
				echo ' | '; 
				echo anchor(site_url('detail_alat/delete/'.$detail_alat->id_detail_alat),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('detail_alat/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('detail_alat/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>


