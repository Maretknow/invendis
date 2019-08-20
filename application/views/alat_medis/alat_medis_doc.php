
        <h2>Alat_medis List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Alat</th>
		<th>Foto Alat</th>
		<th>Jumlah</th>
		<th>Tanggal Alat Medis</th>
		<th>Id Jenis</th>
		
            </tr><?php
            foreach ($alat_medis_data as $alat_medis)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $alat_medis->nama_alat ?></td>
		      <td><?php echo $alat_medis->foto_alat ?></td>
		      <td><?php echo $alat_medis->jumlah ?></td>
		      <td><?php echo $alat_medis->tanggal_alat_medis ?></td>
		      <td><?php echo $alat_medis->id_jenis ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
