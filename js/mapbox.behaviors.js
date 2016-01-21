/**
 * Created by AdamRomyn on 2016/01/17.
 */
(function ($) {


    /**
     * Mapbox with very basic setup
     */
    Drupal.behaviors.mapbox = {
        attach: function (context, setting) {

            // access token for mapbox
            //adamromyn.o4hlh2no
            //pk.eyJ1IjoiYWRhbXJvbXluIiwiYSI6ImNpZ3RsN3ZwdjAwZXl2Ymt1ZHlzcXd5MWgifQ.iJ6mO-P2ORT0MmzGhqbSaA
            var center = setting.mapbox_bridge.center;
            var centerSplit = center.split(',');
            L.mapbox.accessToken = setting.mapbox_bridge.mapbox_accesstoken;
            var map = L.mapbox.map('mapbox-map', setting.mapbox_bridge.mapbox_id)
                .setView([centerSplit[0], centerSplit[1]], setting.mapbox_bridge.zoom_level);
                    // Wait until Mapbox is loaded

            var addMarker = function(title,address){
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        //var myLatLng = {lat: latitude, lng: longitude};
                        L.marker([latitude, longitude]).addTo(map);
                    }
                });

            }

            var startJsonSession = function(){
                jQuery.ajax({
                    url: "http://localhost:3000/muizenberg-locations",
                    dataType: "json",
                    success: function(data) {
                        //var data = [{"title":"location 1","body":"body text","field_lat":"-34.04572","field_long":"18.45413"},{"title":"location 2","body":"body text","field_lat":"-34","field_long":"18.45413"}];
                        jQuery.each(data,function(){
                            //console.log(this.title,this.body,parseFloat(this.field_lat),parseFloat(this.field_long));
                            addMarker(this.title,this.field_listing_address);
                        });
                    }
                });
            }


            var data = startJsonSession();
            //}
        }
    }

})(jQuery);
