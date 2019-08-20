
        <h2 style="margin-top:0px">Admin Read</h2>
        <table class="table">
	    <tr><td>Nama Admin</td><td><?php echo $nama_admin; ?></td></tr>
	    <tr><td>Foto Admin</td><td><?php echo $foto_admin; ?></td></tr>
	    <tr><td>Password Admin</td><td><?php echo $password_admin; ?></td></tr>
	    <tr><td>Username Admin</td><td><?php echo $username_admin; ?></td></tr>
	    <tr><td>Role</td><td><?php echo $role; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>