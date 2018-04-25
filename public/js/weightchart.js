//build bodyweight graph
var ctx = document.getElementById('bodyweightChart').getContext('2d');
var chart = new Chart(ctx, {
	// The type of chart we want to create
	type: 'line',

	// The data for our dataset
	data: {
	    labels: weightxaxis,
	    datasets: [{
	        borderColor: 'rgb(231,76,60)',
	        backgroundColor: 'rgba(231,76,60,0.3',
	        fill: true,
	        pointBackgroundColor: 'rgb(231,76,60)',
	        data: weightyaxis,
	    }]
	},

	// Configuration options go here
	options: {
	    responsive: true,
	    maintainAspectRatio: false,
	    legend: {
	        display: false
	     },
	}
});