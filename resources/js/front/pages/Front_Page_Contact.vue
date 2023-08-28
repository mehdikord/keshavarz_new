<script>
export default {
    name: "Front_Page_Contact"
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <strong class="text-green-7 title q-ml-sm">
                    تماس با تیم کشاورز
                </strong>
                <q-separator class="q-mt-md"/>
            </div>
            <div class="q-mt-md">
                <div class="google-map-box">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3286.559506268671!2d54.44121743145486!3d36.84253451569226!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f83361922a8cacf%3A0x41e8b20d45443161!2sGolestan%20University!5e0!3m2!1sen!2s!4v1690116995461!5m2!1sen!2s"
                        class="google-map__one"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>


</template>

<style scoped>
    .title{
        font-size: 22px;
    }
    .google-map-box {
        position: relative;
        display: block;

    }
    .google-map__one {
        position: relative;
        display: block;
        border: none;
        height: 440px;
        width: 100%;
        border-radius:10px;
        /*mix-blend-mode: luminosity;*/
    }


@media only screen and (max-width: 600px) {
    .title{
        font-size: 18px;
    }
    .google-map__one {
        height: 300px;

        /*mix-blend-mode: luminosity;*/
    }
}
</style>
