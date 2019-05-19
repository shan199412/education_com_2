<?php
if (!defined('ABSPATH')) {
	exit;
}
$username = "zxl101";
$password = "S079z079";
$host = "mytestdb.cjkcq2pcruvk.us-east-2.rds.amazonaws.com";
$database="iter2";

$connect = mysqli_connect( $host, $username, $password, $database );

$myquery4c = "select avg(grand_total) as avg_school_size, c.city_id, city_name, school_type_des from school as s
            join city as c on s.city_id = c.city_id
            join school_type as st on s.st_id = st.st_id
            join education_sector as es on s.es_id = es.es_id
            where grand_total <> 0
            group by city_name, school_type_des;";

$query4c = mysqli_query($connect, $myquery4c);

$sc_size = array();
while ( $row = mysqli_fetch_assoc( $query4c ) ) {
	$element = array();
	$element['school_type'] = $row['school_type_des'];
	$element['school_size'] = $row['avg_school_size'];
	$element['city_id'] = $row['city_id'];
	$element['city_name'] = $row['city_name'];
	$sc_size[] = $element;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="css/edu2city_style.css">
	<script type="text/javascript" src="js/edu2city_script.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

	<link rel="stylesheet" href="css/edu2dia_style.css">
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
	<script src="https://d3js.org/d3-axis.v1.min.js"></script>
</head>

<body>
<br>
<div class="section3" style="text-align: center">
	<p></p>
	<label class="text_label_a">Select up to four Regional Cities to compare:</label>
    <hr>
	<br>
	<div id="checkbox" style="text-align: center">

		<label class="city" id="1">
			<input class="checkcity" type="checkbox" id="1">
			Ballarat
			<span class="checkmark"></span>
		</label>

		<label class="city" id="2">
			<input class="checkcity" type="checkbox" id="2">
			Greater Bendigo
			<span class="checkmark"></span>
		</label>

		<label class="city" id="3">
			<input class="checkcity" type="checkbox" id="3">
			Greater Geelong
			<span class="checkmark"></span>
		</label>

		<label class="city" id="4">
			<input class="checkcity" type="checkbox" id="4">
			Greater Shepparton
			<span class="checkmark"></span>
		</label>

		<label class="city" id="5">
			<input class="checkcity" type="checkbox" id="5">
			Horsham
			<span class="checkmark"></span>
		</label>
		<br>

		<label class="city" id="6">
			<input class="checkcity" type="checkbox" id="6">
			Latrobe
			<span class="checkmark"></span>
		</label>

		<label class="city" id="7">
			<input class="checkcity" type="checkbox" id="7">
			Mildura
			<span class="checkmark"></span>
		</label>

		<label class="city" id="8">
			<input class="checkcity" type="checkbox" id="8">
			Wangaratta
			<span class="checkmark"></span>
		</label>

		<label class="city" id="9">
			<input class="checkcity" type="checkbox" id="9">
			Warrnambool
			<span class="checkmark"></span>
		</label>

		<label class="city" id="10">
			<input class="checkcity" type="checkbox" id="10">
			Wodonga
			<span class="checkmark"></span>
		</label>

	</div>
	<p></p>
	<div class="edu2_button">
		<button class="submit_button_edu2">Submit</button>
	</div>


	<div class="alert1" style="display: none">
		<p style="text-align: center; color: red; font-size: 22px; font-weight: bold;">You can't only choose one city!</p>
	</div>


	<div class="diagram_title" style="display: none">
		<span style="font-size: 20px; font-weight: bold">------ <i class="far fa-chart-bar"> Number of different school in each city in 2017</i> ------</span>
	</div>

	<div class="svg4c" style="display: none">
	</div>

</body>

<script>
    var sc_size = <?php echo json_encode($sc_size); ?>;

</script>
</html>
