function buildliftChart() {
    //get type
    var e = document.getElementById("chooseLiftToDisplay");
    try {
        var titleString = e.options[e.selectedIndex].text;
        titleString = titleString.replace(/ /g, "_");
    }
    catch(err) {
        titleString = "No Types";
    }
    

    var xaxis = new Array();
    var yaxis = new Array();

    for (var i = 0; i < types.length; i++) {
        //only add the elements that are the type the user wants to look at
        if (types[i] == titleString) {
            try {
                var length = xaxis.length;
                //only add the max lift value of that type on that day
                if (xaxis[length-1] == liftxaxis[i]) {
                    if (yaxis[length-1] < liftyaxis[i]) {
                        yaxis[length-1] = liftyaxis[i];
                    }
                }
                else {
                    xaxis.push(liftxaxis[i]);
                    yaxis.push(liftyaxis[i]);
                }
            } catch(err) {
                console.log("except reached");
                xaxis.push(liftxaxis[i]);
                yaxis.push(liftyaxis[i]);
            }
            
        }
    }
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
}

buildliftChart();

function buildweightChart() {
	
}

buildweightChart();




