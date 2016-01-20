/**
 * Created by AdamRomyn on 2016/01/17.
 */
(function ($) {


    /**
     * Mapbox with very basic setup
     */
    Drupal.behaviors.mapbox = {
        attach: function (context, setting) {
            //if (typeof L != 'undefined' && $('#map', context).length) {


                    // access token for mapbox
            L.mapbox.accessToken = 'pk.eyJ1IjoiYWRhbXJvbXluIiwiYSI6ImNpZ3RsN3ZwdjAwZXl2Ymt1ZHlzcXd5MWgifQ.iJ6mO-P2ORT0MmzGhqbSaA';
            var map = L.mapbox.map('mapbox-map', 'adamromyn.o4hlh2no')
                .setView([40, -74.50], 9);
                    // Wait until Mapbox is loaded


            //}
        }
    }

})(jQuery);