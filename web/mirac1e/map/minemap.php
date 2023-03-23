<!DOCTYPE HTML>
<html>
  <head>
        <meta charset="UTF-8">
        <style type="text/css">
body {
  flex-direction: row; 
}
#map {
  height: 500px;
  width: 100%;
}
#searchPlace {
  flex: 2
}
#result{
  height: 400px;
  overflow-y: scroll;
}
#suggest{
  position: absolute;
  display: none;
  background-color: #fff;
  border: 1px solid #000;
  flex-direction : column; 
}
</style>
<link rel="stylesheet" href="assets/css/summer.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script 
        type="text/javascript" 
        src="https://api.longdo.com/map/?key=8284e30839c8abc410d0b43e25f3ab60"
        ></script>
        <script>
          var map;
          var search;
          function init() {
            var map = new longdo.Map({
              placeholder: document.getElementById("map")
            });
               
            search = document.getElementById('search');
            suggest = document.getElementById('suggest');
             map.Search.placeholder(
                document.getElementById('result')
            );
            //When user press an Enter button #search
              search.onkeyup = function(event) {
                if((event || window.event).keyCode != 13)
                  return;
                doSearch();
              }              
              search.oninput = function() {
              if (search.value.length < 3) {
                suggest.style.display = 'none';
                return;
              }
              
              map.Search.suggest(search.value);
            };

            map.Event.bind('location', function() {
              var location = map.location(); // Cross hair location
              //console.log(location);
                                $("#lon").val(location.lon);
                                $("#lat").val(location.lat);

            });

          map.Event.bind('suggest', function(result) {
            if (result.meta.keyword != search.value) return;
            
            suggest.innerHTML = '';
            for (var i = 0, item; item = result.data[i]; ++i) {
              longdo.Util.append(suggest, 'a', {
                innerHTML: item.d,
                href: 'javascript:doSuggest(\'' + item.w + '\')'
              });
            }
            suggest.style.display = 'flex';
          });
                
               function doSearch() {
                map.Search.search(search.value);
                suggest.style.display = 'none';
              }

                function doSuggest(value) {
                      search.value = value;
                      doSearch();
                    }

                map.Event.bind('drop', function() {
                  var location = map.location(); // Cross hair location
                  //console.log(JSON.stringify(location));
                                $("#lon").val(location.lon);
                                $("#lat").val(location.lat);

                });


          }//init


          
        </script>
  </head>
<
  <body onload="init();">
    <br><br><br>
<div class="row">
  <br><br><br>
<div class="col-md-8 col-sm-12">
       <div id="map"></div>
</div>
<div class="col-md-4 col-sm-12">
  <p>ระบุสถานที่,คำค้นหา</p>
       <div id="searchPlace">
        <input id="search" ></input><br>
        <div id="suggest" ></div>
        <div id="result" ></div>
</div></div>
        <input id="lat">
        <input id="lon">
      </div>

                  <center>
                  <div class="row" >       
                  <div class="col-md-12 col-sm-12">             
                        <button type="button" class="btn btn-success">บันทึกสถานที่</button>
                        <button type="button" class="btn btn-danger">ย้อนกลับ</button>
                  </div><br><br>
                  </center>

  </body>
</html>