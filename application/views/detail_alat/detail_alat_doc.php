
        <h2>Detail_alat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Alat</th>
		<th>Id Kondisi</th>
		<th>Jumlah Kondisi</th>
		<th>Tanggal Kondisi</th>
		
            </tr><?php
            foreach ($detail_alat_data as $detail_alat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $detail_alat->id_alat ?></td>
		      <td><?php echo $detail_alat->id_kondisi ?></td>
		      <td><?php echo $detail_alat->jumlah_kondisi ?></td>
		      <td><?php echo $detail_alat->tanggal_kondisi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
