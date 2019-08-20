
        <h2 style="margin-top:0px">Puskesmas List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('puskesmas/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('puskesmas/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('puskesmas'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama Puskesmas</th>
        <th>Keterangan Puskesmas</th>
        <th>Alamat Puskesmas</th>
		<th>Action</th>
            </tr><?php
            foreach ($puskesmas_data as $puskesmas)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $puskesmas->nama_puskesmas ?></td>
            <td><?php echo $puskesmas->keterangan_puskesmas ?></td>
            <td><?php echo $puskesmas->alamat_puskesmas ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('puskesmas/read/'.$puskesmas->id_puskesmas),'Read'); 
				echo ' | '; 
				echo anchor(site_url('puskesmas/update/'.$puskesmas->id_puskesmas),'Update'); 
				echo ' | '; 
				echo anchor(site_url('puskesmas/delete/'.$puskesmas->id_puskesmas),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
