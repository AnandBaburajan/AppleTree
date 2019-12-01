Plotly.d3.csv('https://smashsdgs.me/data/CO2.csv', function(err, rows){

function unpack(rows, key) {
  return rows.map(function(row) { return row[key]; });
}
var scl = [
    ['0.0', 'rgb(165,0,38)'],
    ['0.111111111111', 'rgb(215,48,39)'],
    ['0.222222222222', 'rgb(244,109,67)'],
    ['0.333333333333', 'rgb(253,174,97)'],
    ['0.444444444444', 'rgb(254,224,144)'],
    ['0.555555555556', 'rgb(224,243,248)'],
    ['0.666666666667', 'rgb(171,217,233)'],
    ['0.777777777778', 'rgb(116,173,209)'],
    ['0.888888888889', 'rgb(69,117,180)'],
    ['1.0', 'rgb(49,54,149)']
  ];

var data = [{
  type:'scattergeo',
  locationmode: 'world',
  lon: unpack(rows, 'longitude'),
  lat: unpack(rows, 'latitude'),
  mode: 'markers',
  hoverinfor:  unpack(rows, 'co2'),
  text:  unpack(rows, 'co2'),
  marker: {
      size: 8,
      opacity: 0.5,
      reversescale: true,
      autocolorscale: false,
      symbol: 'square',
      line: {
          width: 1,
          color: 'rgb(102,102,102)'
      },
      colorscale: scl,
      color: unpack(rows, 'co2'),
      cmin: 0
  }
}];

var layout = {
autosize: false,
width: 330,
height: 160,
margin: {
l: 0,
r: 0,
b: 0,
t: 0,
pad: 2
},
paper_bgcolor: '#F2F2F2',
plot_bgcolor: 'white'
};

Plotly.plot(myDiv, data, layout, {responsive: true});

});

var longi = document.getElementById("lon-div");
var longitude = (Math.floor(longi.textContent/5)*5);

var lati = document.getElementById("lat-div");
var latitude = (Math.floor(lati.textContent/5)*5);


var co2;
d3.csv("https://smashsdgs.me/data/CO2.csv", function(data) {
    num = longi.textContent;
    var minDiff=1000;
    var longii;
    for (var i = 0; i < data.length; i++){
         var m=Math.abs(num-data[i].longitude);
         if(m<minDiff){
                minDiff=m;
                longii=data[i].longitude;
            }
      }

    for (var i = 0; i < data.length; i++) {
        if(data[i].longitude==longii)
        {
          var num = lati.textContent;
          var minDiff=1000;
          var ans;
          for (var j = 0; j < data.length; j++){
            if(data[j].longitude==longii){
               var m=Math.abs(num-data[j].latitude);
               if(m<minDiff){
                      minDiff=m;
                      co2=data[j].co2;
                  }
            }
          }
        }
      }
        document.getElementById("co2").innerHTML = co2;
});

d3.csv("https://smashsdgs.me/data/vegetation_index.csv", function(datav) {
    for (var i = 0; i < datav.length; i++) {
        if(datav[i].latitude==(Math.floor(lati.textContent)))
        {
          var num = longi.textContent;
          var minDiff=1000;
          var ans;
          for (var j = 0; j < datav.length; j++){
            if(datav[j].latitude==(Math.floor(lati.textContent))){
               var m=Math.abs(num-datav[j].longitude);
               if(m<minDiff){
                      minDiff=m;
                      ans=datav[j].index;
                  }
            }
          }
        }
      }
  document.getElementById("veg").innerHTML = ans;
});
