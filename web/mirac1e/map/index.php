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
  display: flex;
  flex-direction: row; 
}
#map {
  height: 100%;
  flex: 4;
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
  background-color: #ffffff;
  border: 1px solid #000;
  padding: 4px;
  flex-direction: column;
}
</style>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=f4c1ac18bb09793903d2e925e6268043"></script>
        <script>
          var map;
          var search;
          function init() {
            var map = new longdo.Map({
              placeholder: document.getElementById('map')
            });

            search = document.getElementById('search');
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
              
              map.Search.suggest(search.value, {
                area: 10
              });
            };
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
                
          }//init

               function doSearch() {
                map.Search.search(search.value);
                suggest.style.display = 'none';
              }
              function doSuggest(value) {
              search.value = value;
              doSearch();
            }
          
        </script>
  </head>
  <body onload="init();">
      <div id="map"></div>
      <div id="searchPlace">
        <input id="search"></input>
        <div id="suggest"></div>
        <div id="result"></div>
      </div>
  </body>
</html>