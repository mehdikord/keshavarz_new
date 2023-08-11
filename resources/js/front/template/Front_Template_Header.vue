<script>
export default {
    name: "Front_Template_Header",
    data(){
        return {
            leftDrawerOpen:false,
        }
    },
    methods:{
        toggleLeftDrawer(){
            this.leftDrawerOpen=!this.leftDrawerOpen;
        }
    }
}
</script>

<template>


    <q-header elevated class="bg-blue-grey-10 text-white">
        <q-toolbar>
            <q-btn dense flat round icon="fas fa-list" @click="toggleLeftDrawer" />

            <q-toolbar-title>
                <q-avatar>
                    <img src="/logo.png">
                </q-avatar>
                <strong class="text-positive q-ml-sm page-title">کشاورز</strong>
                <span class="q-ml-sm q-mr-sm">
                    <q-icon name="fas fa-arrow-left" class="font-16"></q-icon>
                </span>
                <span class="page-text">
                    {{this.$route.meta.title}}
                </span>
            </q-toolbar-title>

        </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" behavior="mobile" elevated>
        <!-- drawer content -->
    </q-drawer>

</template>

<style scoped>
.page-text{
    font-size: 16px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .page-text{
        font-size: 13px;
        font-weight: 500;
    }
    .page-title{
        font-size: 18px;
    }
}
</style>
