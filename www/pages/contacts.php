<b>Калуга, ул. Гагарина, д. 4, офис 513.</b><br/>
<b>Телефон:</b> +7(920)615-63-89<br/>
<b>E-mail:</b> cheremnov-kaluga.ru


<div id="map" style="width: 600px; height: 400px"></div>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap;

    function init(){
        myMap = new ymaps.Map("map", {
            center: [54.515009, 36.242424],
            zoom: 15
        });
        myPlacemark = new ymaps.Placemark([54.515009, 36.242424], {
            hintContent: 'ИП Черемнов',
            balloonContent: 'Разработка программного обеспечения'
        });

        myMap.geoObjects.add(myPlacemark);
    }
</script>