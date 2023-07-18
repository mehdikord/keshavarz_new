
<template>
    <section class="section blog-part">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        آخرین نوشته ها
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="i in 4" class="col-md-3">
                    <post_single_one></post_single_one>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="blog-grid.html" class="btn btn-outline">
                            <i class="fas fa-eye"></i><span>مشاهده همه نوشته ها</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.section-heading{
    font-size: 40px;
    font-weight: 700;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Post_Single_One from "../../posts/Front_Post_Single_One.vue";

export default defineComponent({
    name: "Front_Index_Posts",
    components:{
        'post_single_one' : Front_Post_Single_One,
    }
})
</script>
