<template>

    <MapboxMap
        class="q-mt-md"
        style="height: 400px"
        :zoom="8"
        :center="[54.79042804024746,36.8523525341774]"
        access-token="pk.eyJ1IjoibWVoZGlrb3JkIiwiYSI6ImNqeGV1YTdvcjA2aGwzem1kc20xeGhoa2oifQ.-T82K8jlG9RDkzAY42haiw"
        map-style="mapbox://styles/mapbox/satellite-streets-v12">
        <MapboxMarker :color="'red'" @mb-dragend="ChangeLocation" :draggable="true" :lng-lat="marker" />

    </MapboxMap>
    <div class="q-mt-sm">
        <q-btn @click="GetUserLocation" dense color="primary">لوکیشن من</q-btn>
        {{location_get}}
    </div>


</template>

<script>
import { MapboxMap, MapboxMarker,MapboxGeolocateControl } from '@studiometa/vue-mapbox-gl';


export default {
    components :{
        MapboxMap,MapboxMarker,MapboxGeolocateControl
    },
    props:['marker'],
    data(){
      return {
          location:[],
          location_get:null
      }
    },
    methods : {
        ChangeLocation(e){
            this.location=[e.target._lngLat.lng,e.target._lngLat.lat]
        },
        GetUserLocation(e){
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        // Retrieve latitude and longitude
                        this.location=[position.coords.longitude,position.coords.latitude]

                    },
                    (error) => {
                        console.error("Error getting location:", error);
                    }
                );
            } else {
                console.error("Geolocation not available.");
            }
        }


    }
};

</script>
