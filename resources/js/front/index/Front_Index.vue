<template>
    <index_slider_top></index_slider_top>
    <index_categories></index_categories>
    <index_recently></index_recently>
    <index_banner_one></index_banner_one>
    <index_features></index_features>
    <index_new></index_new>
    <index_brands></index_brands>
    <index_comments></index_comments>
    <index_posts></index_posts>
    <index_subscription></index_subscription>
    <index_tools></index_tools>
</template>

<style scoped>
.section{
    margin-bottom: 85px!important;
}
@media only screen and (max-width: 600px) {
    .section{
        margin-bottom: 36px!important;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Index_Slider_Top from "./includes/Front_Index_Slider_Top.vue";
import Front_Index_Categories from "./includes/Front_Index_Categories.vue";
import Front_Index_Recently from "./includes/Front_Index_Recently.vue";
import Front_Index_Banner_One from "./includes/Front_Index_Banner_One.vue";
import Front_Index_Features from "./includes/Front_Index_Features.vue";
import Front_Index_New from "./includes/Front_Index_New.vue";
import Front_Index_Brands from "./includes/Front_Index_Brands.vue";
import Front_Index_Comments from "./includes/Front_Index_Comments.vue";
import Front_Index_Posts from "./includes/Front_Index_Posts.vue";
import Front_Index_Subscription from "./includes/Front_Index_Subscription.vue";
import Front_Index_Tools from "./includes/Front_Index_Tools.vue";

export default defineComponent({
    name: "Front_Index",
    components : {
        'index_slider_top' : Front_Index_Slider_Top,
        'index_categories' : Front_Index_Categories,
        'index_recently' : Front_Index_Recently,
        'index_banner_one' : Front_Index_Banner_One,
        'index_features' : Front_Index_Features,
        'index_new' : Front_Index_New,
        'index_brands' : Front_Index_Brands,
        'index_comments' : Front_Index_Comments,
        'index_posts' : Front_Index_Posts,
        'index_subscription' : Front_Index_Subscription,
        'index_tools' : Front_Index_Tools,
    }
})
</script>
