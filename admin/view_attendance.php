<?php 
if (date('Y') % 4 == 0) {
	$february = 29;	
} else {
	$february = 28;	
}
$count_month  = array (null, 31, $february, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="../include/css/global.css" />
</head>
<body>
<div id="wraper">
<?php include("header.php");
if (isset($_POST['submit'])) {
	$month	= $_POST['month'];
	$year	= $_POST['year'];
	$half_date = $year . '-' . $month;
	$query	= mysql_query("SELECT * FROM attendance WHERE date LIKE '$half_date%' AND user_id=".$_GET['userid']." ORDER BY date");
	$count	= @mysql_num_rows($query);
	if ($count > 0) {
		$i = 0; $date = array();
		while ($row = mysql_fetch_array($query)) {
			$date[$i] = $row['date'];
			$i++;
		}
	} else {
		$_SESSION['success'] = false;
		$date = null;
		$error = '<div class="alert-box '.(( $_SESSION['success'] )?"success":"error").'">There are no records for that date.</div>';
		unset($_SESSION['success']);	
	}
}
?>
<div id="view_attendance"><br /><br />
<?php if(isset($error)) echo $error ?>
    <form action="" method="post">
        <label>Month:</label>
        <select name="month" id="month" class="chosen-select-full-width" >
            <option value="01"<?php if (isset($month) && $month == '01')echo 'selected' ?>>January</option>
            <option value="02"<?php if (isset($month) && $month == '02')echo 'selected' ?>>February</option>
            <option value="03"<?php if (isset($month) && $month == '03')echo 'selected' ?>>March</option>
            <option value="04"<?php if (isset($month) && $month == '04')echo 'selected' ?>>April</option>
            <option value="05"<?php if (isset($month) && $month == '05')echo 'selected' ?>>May</option>
            <option value="06"<?php if (isset($month) && $month == '06')echo 'selected' ?>>June</option>
            <option value="07"<?php if (isset($month) && $month == '07')echo 'selected' ?>>July</option>
            <option value="08"<?php if (isset($month) && $month == '08')echo 'selected' ?>>August</option>
            <option value="09"<?php if (isset($month) && $month == '09')echo 'selected' ?>>September</option>
            <option value="10"<?php if (isset($month) && $month == '10')echo 'selected' ?>>October</option>
            <option value="11"<?php if (isset($month) && $month == '11')echo 'selected' ?>>November</option>
            <option value="12"<?php if (isset($month) && $month == '12')echo 'selected' ?>>December</option>
        </select>
        <label>Year:</label><?php $this_year = date('Y')?>
        <select name="year" id="year"><?php for ($i = 2013; $i <= $this_year;$i++) { ?>
            <option value="<?php echo $i ?>"<?php if(isset($year) && $year == $i) echo 'selected';?>><?php echo $i ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit" value="Filter" />
    </form><?php if (isset($date)) {
	?>
    <table width="50%" border="1">
      <tr>
        <td>Date</td>
        <td>Status</td>
      </tr>
      <?php for($i = 0, $j = 1; $i < $count_month[ltrim($month, '0')]; $i++, $j++) { ?>
      <tr>
        <td><?php 
		if($j < 10) {
			$j = '0' . $j;
		}
		$temp_date = $year . '-' . $month . '-' . $j;
		if ($temp_date > date('Y-m-d')) {
			break;
		} else {
			echo $temp_date = $j . '-' . $month . '-' . $year;	
		}
		?></td>
        <td><?php 
		$temp_date = $year . '-' . $month . '-' . $j;
		if (in_array($temp_date, $date) && $temp_date <= date('Y-m-d')) {
			echo 'Present';
		} else {
			echo '<p>Absent</p>';
		} ?></td>
      </tr>
      <?php } ?>
    </table>
<?php } ?>
</div>
<?php include("footer.php");?>
     
</div>
</body>
</html>
