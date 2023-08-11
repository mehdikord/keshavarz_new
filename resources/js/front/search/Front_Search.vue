<script>
export default {
    name: "Front_Search"
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <strong class="text-green-7 title">
                    جستجو خدمات کشاورز
                </strong>
                <p class="text-justify q-mt-md">
                    کشاورز عزیز ، شما میتوانید ادوات و خدمات مورد نیاز خود را به سادگی جستجو و دریافت کنید .
                    <br>
                    کافیست اطلاعت مورد نیاز را به دقت وارد کرده و دکمه جستجو را بزنید و در وقت خود صرفه جویی کنید !
                </p>
            </div>
            <div class="q-mt-xl">
                <q-select color="green-7" outlined v-model="model"  label="انتخاب دسته بندی ادوات">

                </q-select>
            </div>


        </div>
    </div>

</template>

<style scoped>
.title{
    font-size: 18px;
}
</style>
