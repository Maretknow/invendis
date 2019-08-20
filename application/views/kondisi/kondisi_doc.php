
        <h2>Kondisi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Kondisi</th>
		
            </tr><?php
            foreach ($kondisi_data as $kondisi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kondisi->nama_kondisi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
