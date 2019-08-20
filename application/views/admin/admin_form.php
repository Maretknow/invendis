
        
<?php echo $_SESSION['role']; ?>

        <h2 style="margin-top:0px">Admin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post"  method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Nama Admin <?php echo form_error('nama_admin') ?></label>
            <input type="text" class="form-control" name="nama_admin" id="nama_admin" placeholder="Nama Admin" value="<?php echo $nama_admin; ?>" />
        </div>
	    <div class="form-group">
            <label for="foto_admin">Foto Admin <?php echo form_error('foto_admin') ?></label>
            
            <input type="file" class="form-control" rows="3" name="foto_admin" value="<?php echo $foto_admin; ?> " id="foto_admin" placeholder="foto_admin"/>

            <input type="hidden" class="form-control" rows="3" name="foto_admin" value="<?php echo $foto_admin; ?> " id="foto_admin" placeholder="foto_admin"/>
        </div>
	    <div class="form-group">
            <label for="password_admin">Password Admin <?php echo form_error('password_admin') ?></label>
            <input type="Password" class="form-control" name="password_admin" id="password_admin" placeholder="Password Admin" value="<?php echo $password_admin; ?>" />
            <!-- <textarea class="form-control" rows="3" name="password_admin" id="password_admin" placeholder="Password Admin"><?php echo $password_admin; ?></textarea> -->
        </div>
	    <div class="form-group">
            <label for="varchar">Username Admin <?php echo form_error('username_admin') ?></label>
            <input type="text" class="form-control" name="username_admin" id="username_admin" placeholder="Username Admin" value="<?php echo $username_admin; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Role <?php echo form_error('role') ?></label>
            <!-- <input type="text" class="form-control" name="role" id="role" placeholder="Role" value="<?php echo $role; ?>" /> -->
            <select class="form-control" name="role" id="role">
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
        </div>
	    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
	</form>