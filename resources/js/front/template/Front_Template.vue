<template>
    <header_top></header_top>
    <header_part></header_part>
    <header_navbar_part></header_navbar_part>
    <header_navbar_side></header_navbar_side>
    <footer_mobile></footer_mobile>
    <div>
        <router-view />
    </div>


</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import Front_Template_Header_Top from "./header/Front_Template_Header_Top.vue";
import Front_Template_Header_Part from "./header/Front_Template_Header_Part.vue";
import Front_Template_Header_Navbar_Side from "./header/Front_Template_Header_Navbar_Side.vue";
import Front_Template_Header_Navbar_Part from "./header/Front_Template_Header_Navbar_Part.vue";
import Front_Template_Footer_Mobile from "./footer/Front_Template_Footer_Mobile.vue";

export default defineComponent({
    name: "Front_Template",
    components : {
        'header_top' : Front_Template_Header_Top,
        'header_part' : Front_Template_Header_Part,
        'header_navbar_side' : Front_Template_Header_Navbar_Side,
        'header_navbar_part' : Front_Template_Header_Navbar_Part,
        'footer_mobile' : Front_Template_Footer_Mobile
    }
})
</script>
