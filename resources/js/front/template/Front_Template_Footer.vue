<script>
export default {
    name: "Front_Template_Footer"
}
</script>

<template>
    <q-footer elevated class="text-white" style="background: #1E1E2D">
        <div class="footer-padding">
            <div class="row no-wrap justify-center">
                <div class="col text-center">
                    <router-link :to="{name : 'profile'}">
                        <div  :class="{'text-yellow-8' : this.$route.name === 'profile'}">
                        <q-icon name="fas fa-user" class="icon-size"></q-icon>
                        <div class="menu-text">حساب کاربری</div>
                        </div>
                    </router-link>
                </div>
                <div class="col text-center">
                    <router-link :to="{name : 'search'}">
                        <div  :class="{'text-yellow-8' : this.$route.name === 'search'}">
                            <q-icon name="fas fa-magnifying-glass" class="icon-size"></q-icon>
                            <div class="menu-text">جستجو خدمات</div>
                        </div>
                    </router-link>

                </div>
                <div class="col text-center" >
                    <router-link :to="{name : 'index'}">
                        <div  :class="{'text-yellow-8' : this.$route.name === 'index'}">
                            <q-icon name="fab fa-pagelines" class="icon-size"></q-icon>
                            <div class="menu-text">کشاورز</div>
                        </div>
                    </router-link>

                </div>
                <div class="col text-center">
                    <router-link :to="{name : 'profile_provider'}">
                        <div  :class="{'text-yellow-8' : this.$route.name === 'profile_provider'}">
                            <q-icon name="fas fa-tractor" class="icon-size"></q-icon>
                            <div class="menu-text">ارائه خدمات</div>
                        </div>
                    </router-link>

                </div>
                <div class="col text-center">
                    <router-link :to="{name : 'news'}">
                        <div  :class="{'text-yellow-8' : this.$route.name === 'news'}">
                            <q-icon name="fas fa-mountain-sun" class="icon-size"></q-icon>
                            <div class="menu-text">زمین های من</div>
                        </div>
                    </router-link>

                </div>
            </div>
        </div>
    </q-footer>
</template>

<style scoped>
.footer-padding{
    padding: 10px 2px;
}
.icon-size{
    font-size: 20px;
}
.menu-text{
    margin-top: 4px;
    font-size: 14px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {

    .footer-padding{
        padding: 12px 0 6px;
    }
    .icon-size{
        font-size: 19px;
    }
    .menu-text{
        margin-top: 6px;
        font-size: 11px;
        font-weight: 500;
    }
}
a{
    color: white!important;
}



</style>
