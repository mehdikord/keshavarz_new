<template>
    <MapboxMap v-if="location.length"
        class="q-mt-md"
        style="height: 400px"
        :zoom="8"
        :center="location"
        language="en"
        access-token="pk.eyJ1IjoibWVoZGlrb3JkIiwiYSI6ImNqeGV1YTdvcjA2aGwzem1kc20xeGhoa2oifQ.-T82K8jlG9RDkzAY42haiw"
        map-style="mapbox://styles/mapbox/satellite-streets-v12">
        <MapboxMarker :color="'red'" @mb-dragend="ChangeLocation" :draggable="true" :lng-lat="location" >
        </MapboxMarker>
        <MapboxGeolocateControl  />
    </MapboxMap>
</template>

<script>
import { MapboxMap, MapboxMarker,MapboxGeolocateControl } from '@studiometa/vue-mapbox-gl';

export default {
    components :{
        MapboxMap,MapboxMarker,MapboxGeolocateControl
    },
    mounted() {
        this.location = this.marker
    },
    props:['marker'],
    data(){
      return {
          location:[],
      }
    },
    methods : {
        ChangeLocation(e){
            this.location=[e.target._lngLat.lng,e.target._lngLat.lat]
            this.$emit('UpdateLocation',this.location)
        },
    }
};
</script>
