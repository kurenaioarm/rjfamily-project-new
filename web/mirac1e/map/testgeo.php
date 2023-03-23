  <!DOCTYPE HTML>
  <html>
    <head>
        <meta charset="UTF-8">
        <title>Create Map Sample | Longdo Map</title>
        <style type="text/css">
          html{
            height:100%; 
          }
          body{ 
            margin:0px;
            height:100%; 
          }
          #map {
            height: 100%;
          }
        </style>

        <script type="text/javascript" src="https://api.longdo.com/map/?key=f4c1ac18bb09793903d2e925e6268043"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script>
          var locationListLat = [13,14];
          var locationListLon = [100,101];

          function init() {
            map = new longdo.Map({
              placeholder: document.getElementById('map')
            });
            rerverseGeocoding();
          }

          function rerverseGeocoding() { 
            $.ajax({ 
                    url: "https://api.longdo.com/map/services/addresses?", 
                    dataType: "json", 
                    type: "GET", 
                    contentType: "application/json", 
                    data: {
                        key: "YOUR-KEY-API",
                        lon: locationListLon,
                        lat: locationListLat
                },
                success: function (results)
                {
                    console.log(results);
                },
                error: function (response)
                {
                    console.log(response);
                }
            });
          }
        </script>
    </head>
    <body onload="init();">
        <div id="map"></div>
    </body>
  </html>