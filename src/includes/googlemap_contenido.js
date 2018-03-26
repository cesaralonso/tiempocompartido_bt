$(document).ready(function() {
	var mark;
	var pointA;
	
 var mapContainer = $("#map")[0];
	var bounds = new GLatLngBounds();
	var markers = [];
	var navi ='';
	var i =0;

	if (GBrowserIsCompatible()) {
		var m = $("#map")[0];
		
        if(m) {
			
			var map = new GMap2(m);
			var start = new GLatLng(0,0);
			var zoomLevel = 0;
			
	  map.addControl(new GSmallMapControl);
	  map.setCenter(start, zoomLevel);
			
			var tsTimeStamp= new Date().getTime();
            
			$.get('http://www.tiempocompartido.com/localizaciones/markers_users.xml', { time: tsTimeStamp }, function(data) {  
			
				$(data).find('marker').each(function(){
					
					var lat    = $(this).attr('lat');  
					var lng    = $(this).attr('lng');  
				
					var point  = new GLatLng(lat,lng);  
					var marker = new GMarker(point);  
					markers[i] = marker;
		
					map.addOverlay(marker);  
					i++;
					
					GEvent.addListener(marker, "click", function() {  
						var start = new GLatLng(lat,lng);
						var zoomLevel = 10;
						 map.setCenter(start, zoomLevel, G_HYBRID_MAP);
 		
					});
       				
				});
	
			});
		}
	}
});