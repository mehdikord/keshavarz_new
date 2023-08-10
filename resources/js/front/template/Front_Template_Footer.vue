<script>
export default {
    name: "Front_Template_Footer"
}
</script>

<template>
    <q-footer elevated class="bg-positive text-white">
        <div class="footer-padding">
            <div class="row no-wrap justify-center">
                <div class="col text-center">
                    <q-icon name="fas fa-user" class="icon-size "></q-icon>
                    <div class="menu-text">حساب کاربری</div>

                </div>
                <div class="col text-center">
                    <q-icon name="fas fa-magnifying-glass" class="icon-size"></q-icon>
                    <div class="menu-text">جستجو خدمات</div>

                </div>
                <div class="col text-center">
                    <q-icon name="fab fa-pagelines" class="icon-size"></q-icon>
                    <div class="menu-text">کشاورز</div>
                </div>
                <div class="col text-center">
                    <q-icon name="fas fa-tractor" class="icon-size"></q-icon>
                    <div class="menu-text">ارائه خدمات</div>

                </div>
                <div class="col text-center">
                    <q-icon name="fas fa-newspaper" class="icon-size"></q-icon>
                    <div class="menu-text">اخبار روز</div>

                </div>
            </div>
        </div>
    </q-footer>
</template>

<style scoped>
.footer-padding{
    padding: 8px 2px;
}
.icon-size{
    font-size: 25px;
}
.menu-text{
    margin-top: 3px;
    font-size: 16px;
    font-weight: 600;
}



</style>
