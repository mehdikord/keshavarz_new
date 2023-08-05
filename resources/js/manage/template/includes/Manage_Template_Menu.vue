<template>

    <q-list>
        <template v-for="item in items">

            <template v-if="item.subs.length">

                <q-expansion-item :content-inset-level="0.3" expand-separator :icon="item.icon" :label="item.title">


                    <q-item v-for="sub in item.subs" clickable v-ripple :to="{name : sub.link}">
                        <q-item-section avatar>
                            <q-icon color="deep-orange-8" :name="sub.icon" />
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
                        <q-icon color="deep-orange-8" :name="item.icon" />
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
                            icon  : "mdi-bluetooth",
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
                    title : "سوالات متداول",
                    link : "faqs",
                    icon  : "mdi-help",
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
