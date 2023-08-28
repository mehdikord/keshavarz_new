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

    <q-drawer v-model="leftDrawerOpen" side="left" behavior="mobile" elevated style="background: #212121">
        <q-list >
            <q-item clickable v-ripple :to="{name:'index'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="positive" name="fas fa-home font-28" />
                </q-item-section>
                <q-item-section class="text-white menu-text">صفحه اصلی</q-item-section>
            </q-item>
            <q-separator color="grey-9"/>
            <q-item clickable v-ripple :to="{name:'pages_about'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="positive"  name="fas fa-info-circle font-28" />
                </q-item-section>
                <q-item-section class="text-white menu-text">درباره کشاورز</q-item-section>
            </q-item>
            <q-separator color="grey-9"/>
            <q-item clickable v-ripple :to="{name:'pages_contact'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="positive"  name="fas fa-headset font-28" />
                </q-item-section>
                <q-item-section class="text-white menu-text">ارتباط با ما</q-item-section>
            </q-item>
            <q-separator color="grey-9"/>

        </q-list>
    </q-drawer>

</template>

<style scoped>
.page-text{
    font-size: 16px;
    font-weight: 600;
}
.menu-text{
    font-size: 15px;
    font-weight: 550;
}
.menu-padding{
    padding-top: 14px;
    padding-bottom: 14px;
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
