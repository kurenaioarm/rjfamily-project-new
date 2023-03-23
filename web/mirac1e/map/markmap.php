<!DOCTYPE HTML>
<html>
  <head>
        <meta charset="UTF-8">
        <title>Create Map Sample | Longdo Map</title>
        <style type="text/css">
html {
  height: 100%;
}
body {
  margin: 0px;
  height: 100%;
}
#map {
  height: 100%;
}
</style>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=f4c1ac18bb09793903d2e925e6268043"></script>
        <script>
           var marker = new longdo.Marker({ lon: 100.56, lat: 13.74 }); 
           var marker1 = new longdo.Marker({ lon: 101.2, lat: 12.8 }, 
           {
                title: 'Marker',
                icon: {
                    url: 'https://map.longdo.com/mmmap/images/pin_mark.png',
                    offset: { x: 12, y: 45 }
                },
                detail: 'Drag me',
                visibleRange: { min: 7, max: 9 },
                draggable: true,
                weight: longdo.OverlayWeight.Top,
                });

          function init() {
            var map = new longdo.Map({
              placeholder: document.getElementById('map')
            });

            map.Event.bind('overlayDrop', function(overlay) {
                console.log(overlay)
            });

            map.Overlays.add(marker);
            map.Overlays.add(marker1);
          }
        </script>
  </head>
  <body onload="init();">
      <div id="map"></div>
  </body>
</html>