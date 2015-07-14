<?php  
//include 'class/Kue.php';
include 'class/App.php';

//$app = new App;
//$app->autoloadToday();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trending</title>
  <link rel="icon" href="public/img/trends-icon.png">
	<link rel="stylesheet" href="public/css/materialize.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
</head>
<body>
<nav class="teal">
    <div class="nav-wrapper">
      &nbsp;&nbsp;&nbsp;<a href="index.php" class="brand-logo">Trends</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html"><i class="large mdi-action-home"></i></a></li>
        <li><a href="index.php?p=history">Trend History</a></li>
        <!--<li><a href="javascript.html">Logout</a></li>-->
      </ul>
    </div>
  </nav>
<div class="">
	 <!-- Navbar goes here -->

    <!-- Page Layout here -->
    <div class="row">

      <div class="col s3 ">
        <div class="collection ">
          <li class="collection-item"><b>Menu</b></li>
          <a href="index.php" class="collection-item <?php if(!$_GET['p']){echo 'active';} ?>">Detik Hari Ini</a>
          <a href="index.php?p=history" class="collection-item <?php if($_GET['p']=='history'){echo 'active';} ?>">History</a>
	      </div>
          <ul class="collection with-header">
        <li class="collection-header"><b>10 Trend Hari Ini</b></li>
        <?php  
          $kue = new Kue;
          $sql = $kue->ambilTrendHariIni();
          $query = mysql_query($sql);
          $no=0;
          while ($t = mysql_fetch_assoc($query)) {$no++;
        ?>
        <li class="collection-item"><?php echo $no.". ".$t['kata'] ?><span class="badge"><?php echo $t['jumlah']; ?></span></li>
        <?php } ?>
      </ul>
        
      </div>

      <div class="col s8 card-panel" style="min-height: 625px;">
      <?php  
      $page = isset($_GET['p']);
      if ($page) {
        if (isset($_GET['category'])) {
          include "partials/specific.php";
        }
        else {
          include "partials/".$_GET['p'].".php";
        }
      }
      else{
        include "partials/home.php";
      }
      ?>
      </div>

    </div>
</div>

<footer class="page-footer teal">
        
          <div class="footer-copyright">
            <div class="container">
            Copyright Kevin Magdareva 2015
            </div>
          </div>
        </footer>

<script type="text/javascript" src="public/js/jquery-2.1.3.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  </script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready( function () {    $('#table_id').DataTable();} );
</script>
<script type="text/javascript" src="public/js/materialize.min.js"></script>
<script type="text/javascript" src="public/plugin/highcharts/js/highcharts.js"></script>
<script type="text/javascript">
 
</script>
</body>
</html>