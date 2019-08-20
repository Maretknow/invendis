
        <h2>Puskesmas List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Puskesmas</th>
        <th>Keterngan Puskesmas</th>
        <th>Alamat Puskesmas</th>
		
            </tr><?php
            foreach ($puskesmas_data as $puskesmas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $puskesmas->nama_puskesmas ?></td>	
              <td><?php echo $puskesmas->keterangan_puskesmas ?></td> 
              <td><?php echo $puskesmas->alamat_puskesmas ?></td> 
                </tr>
                <?php
            }
            ?>
        </table>
