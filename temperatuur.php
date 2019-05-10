<?php
	$mysqli = new mysqli('localhost', 'pi', 'raspberry', 'temperature');
	if ($mysqli->connect_error) {
    		die('Connect Error (' . $mysqli->connect_errno . ') '
        	. $mysqli->connect_error);
	}
?>

<table id="tabel" class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th>Temperaturen</th>
		</tr>
	</thead>

	<?php
		$result = $mysqli->query("SELECT * FROM temperature");
		while ($row = $result->fetch_assoc()) {
    			print '<tr id="rij">';
    			print "<td>" . $row["TEMP"] . "</td>";
    			print "</tr>";
		}
	?>
</tbody>

<html>
	<head>
		<script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
		<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
		<script type="text/javascript">
			$(window).on("load", function(){
				var rij = document.getElementById("rij");
				var waarden = rij.getElementsByTagName("td");
				var aTabel = document.getElementById("tabel");
				var array = [];
				for (var i=1; i < tabel.rows.length;i++){
					var aWaarden = aTabel.rows.item(i).cells;
					var array2 = [i,parseInt(aWaarden[0].firstChild.data)];
					array.push(array2);
				}
				google.charts.load('current', {'packages':['line']});
				google.charts.setOnLoadCallback(drawChart);
				function drawChart() {
					var data = new google.visualization.DataTable();
					data.addColumn('number', 'Tijd');
					data.addColumn('number', 'Temperatuur');
					data.addRows(array);
					var options = {
						chart: {
							title: 'Temperatuur',
							subtitle: 'in graden celsius.'
						},
					width: 1400,
					height: 700
					};
				var chart = new google.charts.Line(document.getElementById('linechart_material'));
				chart.draw(data, google.charts.Line.convertOptions(options));
			}
		});
		</script>
	</head>

	<body>
		<div id="linechart_material"><div>
	</body>
</html>
