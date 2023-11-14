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


    <q-header elevated class="top-menu text-white" >
        <q-toolbar>

            <q-btn  flat round icon="fas fa-list" @click="toggleLeftDrawer" />

            <q-toolbar-title class="text-right" >
                <router-link :to="{name : 'index'}">
                    <strong class="text-yellow-8 q-mr-sm page-title">کشاورز</strong>
                    <q-avatar>
                        <img src="/logo.png">
                    </q-avatar>
                </router-link>
            </q-toolbar-title>

        </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" behavior="mobile" elevated style="background: #1E1E2D">
        <q-list >
            <q-item clickable v-ripple :to="{name:'index'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7" name="fas fa-home font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">صفحه اصلی</q-item-section>
            </q-item>
            <q-separator  />
            <q-item clickable v-ripple :to="{name:'plans'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-id-card-clip font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">دریافت اشتراک</q-item-section>
            </q-item>
            <q-separator/>
            <q-item clickable v-ripple :to="{name:'news'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7" name="fas fa-newspaper font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">خبرنامه کشاورزی</q-item-section>
            </q-item>
            <q-separator  />

            <q-item clickable v-ripple :to="{name:'implements_request'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-star font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">درخواست ثبت ادوات</q-item-section>
            </q-item>
            <q-separator/>
            <q-item clickable v-ripple :to="{name:'pages_about'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-info-circle font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">درباره کشاورز</q-item-section>
            </q-item>
            <q-separator/>

            <q-item clickable v-ripple :to="{name:'pages_contact'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-headset font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">ارتباط با ما</q-item-section>
            </q-item>
            <q-separator/>
            <q-item clickable v-ripple :to="{name:'pages_services'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-table-cells-large font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">خدمات کشاورز</q-item-section>
            </q-item>
            <q-separator/>
            <q-item clickable v-ripple :to="{name:'pages_faqs'}" class="menu-padding">
                <q-item-section avatar >
                    <q-icon color="yellow-7"  name="fas fa-question font-26" />
                </q-item-section>
                <q-item-section class="text-white menu-text">سوالات متداول</q-item-section>
            </q-item>
            <q-separator/>
        </q-list>
    </q-drawer>

</template>

<style scoped>
.w-85{
    width: 90%!important;
}
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
.top-menu{
    background: #1E1E2D;
    padding-top: 7px;
    padding-bottom: 7px;
}
@media only screen and (max-width: 600px) {
    .page-text{
        font-size: 13px;
        font-weight: 500;
    }
    .page-title{
        font-size: 16px;
    }
    .top-menu{
        background: #1E1E2D;
        padding-top: 3px;
        padding-bottom: 3px;
    }
}
</style>
