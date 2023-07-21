<template>

    <q-layout view="hHh lpR fFf">
        <q-header elevated class="bg-indigo text-white q-py-sm">
            <q-toolbar>
                <q-btn v-if="this.$route.name !== 'login'" dense flat round icon="mdi-menu" @click="toggleLeftDrawer"></q-btn>

                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"  alt="test">
                    </q-avatar>
                    Control Panel
                </q-toolbar-title>
                <q-btn color="teal" icon="mdi-account" round size="md">
                    <q-menu
                        transition-show="flip-right"
                        transition-hide="flip-left"
                    >
                        <q-list style="min-width: 200px">
                            <q-item>
                                <q-icon name="mdi-account" size="md" color="indigo"></q-icon>
                                <strong class="q-mt-xs">
                                    {{ AuthUser.name }}
                                </strong>
                            </q-item>
                            <q-item>
                                <q-icon name="mdi-email" size="md" color="indigo"></q-icon>
                                <strong class="q-mt-xs">
                                    {{ AuthUser.email }}
                                </strong>
                            </q-item>

                            <q-separator />
                            <q-item clickable>
                                <q-icon name="mdi-exit" size="md" color="dark"></q-icon>
                                <strong class="q-mt-xs text-red">
                                    Logout
                                </strong>

                            </q-item>
                        </q-list>
                    </q-menu>
                </q-btn>

            </q-toolbar>
        </q-header>

        <q-drawer v-if="this.$route.name !== 'login'" show-if-above v-model="leftDrawerOpen" side="left" bordered>

            <!-- drawer content -->
            <Template_Menu></Template_Menu>


        </q-drawer>

        <q-page-container>
                <div class="q-pa-md">
                    <h6 class="q-mt-xs q-mb-md text-teal-6 font-18">{{ this.$route.meta.title }}</h6>
                    <Template_Content></Template_Content>
                </div>
        </q-page-container>

    </q-layout>



</template>

<script>
import {ref} from 'vue';
import Manage_Template_Menu from "./includes/Manage_Template_Menu.vue";
import Manage_Template_Content from "./includes/Manage_Template_Content.vue";
import {mapGetters} from "vuex";
export default {

    name: "show",
    components: {
        "Template_Menu" : Manage_Template_Menu,
        'Template_Content' : Manage_Template_Content
    },
    setup () {
        const leftDrawerOpen = ref(false)
        const rightDrawerOpen = ref(false)

        return {
            leftDrawerOpen,
            toggleLeftDrawer () {
                leftDrawerOpen.value = !leftDrawerOpen.value
            },

            rightDrawerOpen,
            toggleRightDrawer () {
                rightDrawerOpen.value = !rightDrawerOpen.value
            }
        }
    },
    computed : {
        ...mapGetters({
            AuthUser : "AuthManageUser",
        })
    }

}
</script>

<style scoped>

</style>
