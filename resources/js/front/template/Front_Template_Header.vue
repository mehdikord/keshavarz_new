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
                <strong class="text-green-4">کشاورز</strong>
            </q-toolbar-title>
        </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" behavior="mobile" elevated>
        <!-- drawer content -->
    </q-drawer>

</template>

<style scoped>

</style>
