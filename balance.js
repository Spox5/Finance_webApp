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
			table = document.getElementById("table");
			lastRow = table.rows.length;
			row = table.insertRow(lastRow);

			cell = row.insertCell(0);
			cell.setAttribute("class", "rowItem");
			textNode = document.createTextNode("Przykładowa kategoria");
			cell.appendChild(textNode);
			
			cell = row.insertCell(1);
			cell.setAttribute("class", "rowItem");
			textNode = document.createTextNode(100);
			cell.appendChild(textNode);
			
			sum = sum + parseInt(textNode.nodeValue);
		}

		table = document.getElementById("table");
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

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Rodzaj', 'Kwota'],
          
		  <?php
		  
			while($row=$result->fetch_assoc())
			{
				echo "['".$row['expense_category_assigned_to_user']."',".$row['SUM(amount)']."],";
			}
		  
		  ?>
		  
        ]);

        var options = {
          title: 'Wydatki'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

window.onload = pageLoad;