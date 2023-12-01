<script>
import "../../../../node_modules/mapbox-gl/dist/mapbox-gl.css"

import mapboxgl from "mapbox-gl";
mapboxgl.accessToken = "pk.eyJ1IjoibWVoZGlrb3JkIiwiYSI6ImNqeGV1YTdvcjA2aGwzem1kc20xeGhoa2oifQ.-T82K8jlG9RDkzAY42haiw"
export default {
    name: "Front_Global_Map",
    mounted() {
        const map = new mapboxgl.Map({
            container: this.$refs.mapContainer,
            style: "mapbox://styles/mapbox/satellite-streets-v12", // Replace with your preferred map style

            center: [54.43313598632812 ,36.83951508755615],
            zoom: 9,
        });

        this.map = map;
    },

}
</script>

<template>
    <div ref="mapContainer" class="map-container"></div>

</template>

<style scoped>
.map-container {
    flex: 1!important;
    width: 100%;
    height: 500px;
    display: block!important;
}
</style>
