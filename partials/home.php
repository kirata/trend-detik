<p>
<form action="action/process.php" method="post" accept-charset="utf-8">
	 <button type="submit"  class="btn-floating btn-large waves-effect waves-light red " name="proses" style="float:left;margin-top: 10px;"><i class="mdi-navigation-refresh"></i></button>
</form>
<table id="table_id" class="display">
<thead>
	<tr>
		<th width="5%">No</th>
		<th>Judul</th>
	</tr>
</thead>
<tbody>
	<?php 
	$tggl = date("Y/m/d"); 
	$q = mysql_query("SELECT * FROM judul WHERE tanggal_judul='$tggl' ORDER by tanggal_judul ASC");
	$no=0;
	while ($a = mysql_fetch_assoc($q)) {$no++;
	?>
	<tr>
		<td><?php echo $no; ?></td>
		<td><a href="<?php echo $a['link'] ?>" target="_blank"><?php echo $a['judul']; ?></a></td>
	</tr>
	<?php } ?>
</tbody>
</table>
<!--
<div id="carat" style="width:100%; height:400px;"></div>-->
</p>
