<script>
export default {
    name: "Front_Index_Weather",
    data(){
        return {
            weather : null,
            location : {},
        }
    },
    mounted() {
        this.Get_Location();
        console.log(this.location)
        this.Get_Weather();

    },
    methods : {
        Get_Weather(){
            const params = {
                location : this.location.lat+','+this.location.lng
            }
            axios.post('public/weathers/current',params).then(res => {
                this.weather = res.data.result

            }).catch(error => {
                console.log(error)
            })

        },
        Get_Location() {
            this.location={
                lat: 36.845532,
                lng: 54.432568,
            }
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        this.location = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                    },
                    (error) => {
                        alert("Unable to retrieve your location");
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        },

    }
}
</script>

<template>
    <div class="news-title font-iransans text-green-8">
        وضعیت آب و هوا
    </div>
    <div v-if="!weather" class="col-12 text-center">
        <global_info_loading></global_info_loading>
    </div>
    <template v-else class="">
        <div class="text-center">
            <img :src="'https://openweathermap.org/img/wn/'+weather.weather[0].icon+'@4x.png'" />
            <div class="q-mb-sm text-center">
                <strong class="font-18">{{weather.name}}</strong>
            </div>
            <div class="text-center" dir="ltr">
                 <strong class="font-34 text-grey-8 "> {{weather.main.temp}} </strong> <span class="font-20 text-grey-6">C&deg;</span>
            </div>
            <div class="text-center">
                <strong class="text-teal-8">{{weather.weather[0].description}}</strong>
            </div>
            <div class="row q-mt-md q-mb-lg">
                <div class="col-md-3 col-sm-6 col-xs-6 q-mb-md text-center" dir="ltr">
                    <q-icon name="fa fa-wind" class="text-orange" size="30px"></q-icon>
                    <div class="q-mt-md"><strong class="text-grey-9 font-15">{{weather.wind.speed}}</strong> <span class="text-grey-6">p/s</span></div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 q-mb-md text-center" dir="ltr">
                    <q-icon name="fa fa-gauge-high" class="text-purple-8" size="30px"></q-icon>
                    <div class="q-mt-md"><strong class="text-grey-9 font-15">{{weather.main.pressure}}</strong> <span class="text-grey-6">hPa</span></div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 q-mb-md text-center" dir="ltr">
                    <q-icon name="fa fa-temperature-arrow-down" class="text-blue" size="30px"></q-icon>
                    <div class="q-mt-md"><strong class="text-grey-9 font-15">{{weather.main.temp_min}}</strong> <span class="text-grey-6">C&deg;</span></div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 q-mb-md text-center" dir="ltr">
                    <q-icon name="fa fa-temperature-arrow-up" class="text-red" size="30px"></q-icon>
                    <div class="q-mt-md"><strong class="text-grey-9 font-15">{{weather.main.temp_max}}</strong> <span class="text-grey-6">C&deg;</span></div>
                </div>

            </div>
        </div>
    </template>

</template>

<style scoped>
.news-title{
    font-size: 22px;
    font-weight: 600;
}

@media only screen and (max-width: 600px) {

    .news-title{
        font-size: 18px;
        font-weight: 600;
    }
}
</style>
