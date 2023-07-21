
<template>
    <div class="text-center">
        <div class="brand-media text-center">
            <img src="/front/images/brand/01.jpg" alt="brand">
            <div class="brand-overlay">
                <a href="">
                    <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
        <div class="brand-meta mt-1">
            <h6 class="title"> استارباکس</h6>
            <small class="mt-1">(38 محصول)</small>
        </div>
    </div>
</template>

<style scoped>
.brand-media::before{
    width: 150px;
    height: 150px;
}
.brand-media img{
    width: 135px;
    height: 135px;
}
.title{
    font-size: 18px;
}

@media only screen and (max-width: 750px) {
    .brand-media::before{
        width: 110px;
        height: 110px;
    }
    .brand-media img{
        width: 80px;
        height: 80px;
    }
    .title{
        font-size: 13px;
    }

}
@media only screen and (max-width: 600px) {
    .brand-media::before{
        width: 80px;
        height: 80px;
    }
    .brand-media img{
        width: 60px;
        height: 60px;
    }
    .title{
        font-size: 13px;
    }

}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Brand_One"
})
</script>
