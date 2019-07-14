/*function showMenu() {
  document.getElementById("dropdownbalance").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('#dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}*/

var sum = 0;
var table;
var lastRow;
var row;
var cell;
var textNode;

function showCurrentMonth()
{	
	if (document.getElementById("dropbtn").innerHTML != "Bieżący miesiąc")
	{
		document.getElementById("dropbtn").innerHTML = "Bieżący miesiąc";
			
		for (i=0; i<7; i++)
		{	
			table = document.getElementById("table1");
			lastRow = table.rows.length;
			row = table.insertRow(lastRow);

			cell = row.insertCell(0);
			cell.setAttribute("class", "rowItem");
			textNode = document.createTextNode("Praca");
			cell.appendChild(textNode);
			
			cell = row.insertCell(1);
			cell.setAttribute("class", "rowItem");
			textNode = document.createTextNode(100);
			cell.appendChild(textNode);
			
			sum = sum + parseInt(textNode.nodeValue);
		}

		table = document.getElementById("table1");
		lastRow = table.rows.length;
		row = table.insertRow(lastRow);

		cell = row.insertCell(0);
		cell.setAttribute("class", "rowItem");
		textNode = document.createTextNode("Suma: ");
		cell.appendChild(textNode);
		
		cell = row.insertCell(1);
		cell.setAttribute("class", "rowItem");
		textNode = document.createTextNode(sum);
		cell.appendChild(textNode);
	}
}

// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() 
{
	var data = google.visualization.arrayToDataTable([
	['Categories', 'Amount'],
	['Work', 80],
	['Friends', 2],
	['Eat', 2],
	['TV', 2],
	['Gym', 2],
	['Sleep', 8]
	]);

  // Optional; add a title and set the width and height of the chart
	var options = {title: "Przykładowy wykres", 'width':450, 'height':300, backgroundColor:'#303030', 'fontSize':15, pieHole: 0.5, legend: {position: 'labeled', textStyle: {color: 'white'}},
	chartArea: {width:'90%',height:'80%'}, pieSliceText: 'none'};


  // Display the chart inside the <div> element with id="piechart"
	var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	chart.draw(data, options);
}

function pageLoad()
{
	showCurrentMonth();
	drawChart();
}

window.onload = pageLoad;