<p>
<form method="post" action="">
Tanggal: <input type="text" id="datepicker" name="tanggal">
<button class="btn waves-effect waves-light" type="submit" name="action">
Proses <i class="mdi-content-send right"></i>
</button>
</form>

<?php  
if (isset($_POST['tanggal'])) {
?>
<table id="table_id" class="display">
<thead>
	<tr>
		<th width="5%">Urutan</th>
		<th>Kata</th>
		<th>Jumlah</th>
	</tr>
</thead>
<tbody>
	<?php 
	$tggl = $_POST['tanggal']; 
	$q = mysql_query("SELECT * FROM kata WHERE tanggal_kata='$tggl' ORDER by jumlah DESC");
	$no=0;
	while ($a = mysql_fetch_assoc($q)) {$no++;
	?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $a['kata']; ?></td>
		<td><?php echo $a['jumlah']; ?></td>
	</tr>
	<?php } ?>
</tbody>
</table>
<?php }else {} ?>
</p>