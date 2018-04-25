const app = new Vue({
	el: '#app',
	data: {
		newType: false,
		displayingLift: displayLift,
		types: types,
		liftxaxis: liftxaxis,
		liftyaxis: liftyaxis,
		showDropDown: false
	},
	methods: {
		//affect type in newliftdiv
		fillType() {
			if ($('#lifttypes').val() == 'addnew') {
				this.newType = !this.newType;
			}
		},

		unfillType() {
			this.newType = false;
		},

		//affect text inputs
		checkInput(value, pid, reset) {
			if (isNaN(value)) {
				$('#' + pid).html("<img src='./images/warning.png' height='20' width='20' style='margin-right: 5px;'>Invalid Input")
			} else {
				$('#' + pid).text(reset);
			}
		},

		toggleDropDown() {
			this.showDropDown = !this.showDropDown;
		},

		//lift chart functions
		updateLiftChart() {
			this.displayingLift = $('#chooseLiftToDisplay').val();
			this.buildLiftChart();
		},

		buildLiftChart() {
			axes = this.buildAxes();
			xaxis = axes.xaxis;
			yaxis = axes.yaxis;

			var ctx = document.getElementById('myChart').getContext('2d');
			var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'line',
		    // The data for our dataset
		    data: {
		        labels: xaxis,
		        datasets: [{
		            borderColor: 'rgb(231,76,60)',
		            backgroundColor: 'rgba(231,76,60,0.3',
		            fill: true,
		            data: yaxis,
		            pointBackgroundColor: 'rgb(231,76,60)',

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

		    $('#myChart').hide().fadeIn(1000);
		},

		buildAxes() {
			var titleString = this.displayingLift;
		    var xaxis = new Array();
		    var yaxis = new Array();

		    for (var i = 0; i < this.types.length; i++) {
		        //only add the elements that are the type the user wants to look at
		        if (this.types[i] == titleString) {
		            try {
		                var length = xaxis.length;
		                //only add the max lift value of that type on that day
		                if (xaxis[length-1] == this.liftxaxis[i]) {
		                    if (yaxis[length-1] < this.liftyaxis[i]) {
		                        yaxis[length-1] = this.liftyaxis[i];
		                    }
		                } else {
		                    xaxis.push(this.liftxaxis[i]);
		                    yaxis.push(this.liftyaxis[i]);
		                }
		            } catch(err) {
		                console.log("except reached");
		                xaxis.push(this.liftxaxis[i]);
		                yaxis.push(this.liftyaxis[i]);
		            }
		        }
		    }
		    return {xaxis: xaxis, yaxis: yaxis};
		}
	}
});

app.buildLiftChart();
$('#chooseLiftToDisplay').val(displayLift);