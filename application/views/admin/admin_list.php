
        <h2 style="margin-top:0px">Admin List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('admin/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama Admin</th>
		<th>Foto Admin</th>
		<th>Password Admin</th>
		<th>Username Admin</th>
		<th>Role</th>
		<th>Action</th>
            </tr><?php foreach ($admin_data as $admin)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $admin->nama_admin ?></td>
			<!-- <td><a href="#" class="pop"><img width="50" height="50" src="<?php echo base_url(); ?>upload/foto_admin/<?php// echo $admin->foto_admin ?>"></a></td> -->

             <td><a href="#" class="pop"><img width="50" height="50" src="https://invendis.s3.amazonaws.com/<?php  $picadmin = str_replace(' ', '+', $admin->foto_admin); echo $picadmin ?>"></a></td> 
			<td><?php $pass=strlen($admin->password_admin); echo str_repeat("*", $pass); ?></td>
			<td><?php echo $admin->username_admin ?></td>
			<td><?php echo $admin->role ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('admin/read/'.$admin->id_admin),'Read'); 
				echo ' | '; 
				echo anchor(site_url('admin/update/'.$admin->id_admin),'Update'); 
				echo ' | '; 
				echo anchor(site_url('admin/delete/'.$admin->id_admin),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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