
        <h2>Jenis List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Jenis</th>
		
            </tr><?php
            foreach ($jenis_data as $jenis)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jenis->nama_jenis ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
