<template>

    <q-list>
        <template v-for="item in items">

            <template v-if="item.subs.length">

                <q-expansion-item :content-inset-level="0.3" expand-separator :icon="item.icon + ' text-blue-grey-8'" :label="item.title">

                    <q-item v-for="sub in item.subs" clickable v-ripple :to="{name : sub.link}">
                        <q-item-section avatar>
                            <q-icon color="deep-orange-9" :name="sub.icon" />
                        </q-item-section>
                        <q-item-section>
                            {{sub.title}}
                        </q-item-section>
                    </q-item>

                </q-expansion-item>

            </template>
            <template v-else>
                <q-item clickable v-ripple :to="{name : item.link}">
                    <q-item-section avatar>
                        <q-icon color="deep-orange-9" :name="item.icon" />
                    </q-item-section>
                    <q-item-section>
                        {{item.title}}
                    </q-item-section>
                </q-item>
            </template>


        </template>

    </q-list>
</template>

<script>
export default {
    name: "Manage_Template_Menu",
    data(){
        return {
            items:[
                {
                    title : "داشبورد",
                    link : "dashboard",
                    icon  : "mdi-view-dashboard",
                    subs:[

                    ]
                },
                {
                    title : "کاربران سیستم",
                    link : "",
                    icon  : "mdi-account-group",
                    subs:[
                        {
                            title : "مدیران",
                            link : "users_managers",
                            icon  : "mdi-account-tie",
                        },
                        {
                            title : "مشتریان",
                            link : "users_members",
                            icon  : "mdi-account-group",
                        },
                        {
                            title : "مشتریان حذف شده",
                            link : "users_members",
                            icon  : "mdi-account-remove",
                        },

                    ]
                },
                {
                    title : "مدیریت ادوات",
                    link : "",
                    icon  : "mdi-tractor",
                    subs:[
                        {
                            title : "دسته بندی ها",
                            link : "implements_categories",
                            icon  : "mdi-shape-plus",
                        },
                        {
                            title : "لیست ادوات",
                            link : "implements",
                            icon  : "mdi-tractor",
                        },
                        {
                            title : "فرم ها",
                            link : "implements_forms",
                            icon  : "mdi-text",
                        },
                    ]
                },

                {
                    title : "برند ها و دسته بندی ",
                    link : "",
                    icon  : "mdi-shape-plus",
                    subs:[
                        {
                            title : "برند ها",
                            link : "brands",
                            icon  : "mdi-copyright",
                        },
                        {
                            title : "دسته بندی ها",
                            link : "categories",
                            icon  : "mdi-bluetooth",
                        },

                    ]
                },
                {
                    title : "محصولات و فروشگاه ",
                    link : "",
                    icon  : "mdi-shopping",
                    subs:[
                        {
                            title : "محصولات",
                            link : "products",
                            icon  : "mdi-package",
                        },

                    ]
                },
                {
                    title : "مدیریت اشتراک ها",
                    link : "",
                    icon  : "mdi-star",
                    subs:[
                        {
                            title : "خدمات دهنده",
                            link : "plans_providers",
                            icon  : "mdi-tractor-variant",
                        },
                        {
                            title : "خدمات گیرنده",
                            link : "plans_customers",
                            icon  : "mdi-face-agent",
                        }
                    ]
                },
                {
                    title : "امور مالی",
                    link : "invoices",
                    icon  : "mdi-bank",
                    subs:[

                    ]
                },
                {
                    title : "خبر ها",
                    link : "news",
                    icon  : "mdi-newspaper",
                    subs:[

                    ]
                },
                {
                    title : "ادوات ارسالی",
                    link : "implements_requests",
                    icon  : "mdi-comment-plus",
                    subs:[

                    ]
                },
                {
                    title : "تنظیمات اسلایدر",
                    link : "slider",
                    icon  : "mdi-image",
                    subs:[

                    ]
                },
                {
                    title : "پیام های ارسالی",
                    link : "contacts",
                    icon  : "mdi-email",
                    subs:[

                    ]
                },
                {
                    title : "سوالات متداول",
                    link : "faqs",
                    icon  : "mdi-help",
                    subs:[

                    ]
                },
                {
                    title : "درخواست ها",
                    link : "searches",
                    icon  : "mdi-magnify-expand",
                    subs:[

                    ]
                },


            ]
        }
    }
}
</script>

<style scoped>

</style>
