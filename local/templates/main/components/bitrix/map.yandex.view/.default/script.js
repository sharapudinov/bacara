if (!window.BX_YMapAddPlacemark)
{
	window.BX_YMapAddPlacemark = function(map, arPlacemark)
	{
		if (null == map)
			return false;

		if(!arPlacemark.LAT || !arPlacemark.LON)
			return false;

		var props = {};
		if (null != arPlacemark.TEXT && arPlacemark.TEXT.length > 0)
		{
			var value_view = '';

			if (arPlacemark.TEXT.length > 0)
			{
				var rnpos = arPlacemark.TEXT.indexOf("\n");
				value_view = rnpos <= 0 ? arPlacemark.TEXT : arPlacemark.TEXT.substring(0, rnpos);
			}

			props.balloonContent = arPlacemark.TEXT.replace(/\n/g, '<br />');
			props.hintContent = value_view;
            //props.iconContent = 'ООО Блэк Баккара';
            props.iconContent = '<img src="/img/logo.png">';
		}

		var obPlacemark = new ymaps.Placemark(
			[arPlacemark.LAT, arPlacemark.LON],
			props,
			{
                balloonCloseButton: true,
/*                 iconImageHref:"/bitrix/templates/main/images/logo2.jpg",
                iconImageSize: [50, 50], */
            }
		);
        
        var myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [arPlacemark.LAT, arPlacemark.LON]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: '<img width="60" height="60" src="/img/logo.png">',
                balloonContent: 'ООО «Блэк Баккара» Россия, Москва, Рижская площадь , дом 9 , строение 2А.'
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'twirl#darkgreenStretchyIcon'/* ,
            // Метку можно перемещать.
            draggable: true */
        });

	//	map.geoObjects.add(obPlacemark);
		map.geoObjects.add(myGeoObject);

		return obPlacemark;
	}
}

if (!window.BX_YMapAddPolyline)
{
	window.BX_YMapAddPolyline = function(map, arPolyline)
	{
		if (null == map)
			return false;

		if (null != arPolyline.POINTS && arPolyline.POINTS.length > 1)
		{
			var arPoints = [];
			for (var i = 0, len = arPolyline.POINTS.length; i < len; i++)
			{
				arPoints.push([arPolyline.POINTS[i].LAT, arPolyline.POINTS[i].LON]);
			}
		}
		else
		{
			return false;
		}

		var obParams = {clickable: true};
		if (null != arPolyline.STYLE)
		{
			obParams.strokeColor = arPolyline.STYLE.strokeColor;
			obParams.strokeWidth = arPolyline.STYLE.strokeWidth;
		}
		var obPolyline = new ymaps.Polyline(
			arPoints, {balloonContent: arPolyline.TITLE}, obParams
		);

		map.geoObjects.add(obPolyline);

		return obPolyline;
	}
}
 
/* $(document).ready(function() {
    setTimeout(function() {
        $('.ymaps-image-with-content-content > ymaps > ymaps').html('<img src="/bitrix/templates/main/images/logo.png">');
    }, 1000);
}); */