<template>
    <div class="row justify-center">
        <div class="col-md-4 col-sm-9 col-xs-11">

            <q-card class="q-mt-xl">
                <div class="text-center">
                    <q-img class="top-img" src="/assets/images/bg/login-animation.svg"></q-img>
                </div>
                <q-card-section>
                    <h5 class="text-center q-my-md">Login to Control Panel</h5>
                    <p class="text-center text-grey-7 q-my-md">insert your email and password for login to account</p>
                    <div class="q-my-xl q-px-lg ">
                        <q-input lazy-rules  type="email" outlined v-model="login.email" label="Email" color="primary" class="q-my-md" :error="this.MixinValidationCheck(errors,'email')">
                            <template v-slot:append>
                                <q-icon size="lg" name="mdi-email" color="teal"/>
                            </template>
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'email')"></Error_Validation>
                            </template>
                        </q-input>
                        <q-input type="password" outlined v-model="login.password" label="Password" color="primary" class="q-my-md" :error="this.MixinValidationCheck(errors,'password')">
                            <template v-slot:append>
                                <q-icon size="lg" name="mdi-lock" color="red-6"/>
                            </template>
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'password')"></Error_Validation>
                            </template>
                        </q-input>

                    </div>
                    <div class="text-center q-mt-xl q-mb-lg">
                        <q-btn color="indigo" :loading="loading" push padding="14px" icon-right="mdi-send" label="Login to account" @click="Login">
                            <template v-slot:loading>
                                <q-spinner-hourglass class="on-left" />
                                Loading...
                            </template>
                        </q-btn>
                    </div>
                </q-card-section>
            </q-card>
        </div>

    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    created() {

    },
    data() {
        return {
            login: {
                email: null,
                password: null,
            },
            loading: false,
            errors: [],
        }
    },
    methods: {
        ...mapActions([
            'Auth_Manage_Login'
        ]),

        Login() {
            this.loading = true;
            axios.post('auth/login', this.login).then(res => {
                console.log(res.data)
                this.Auth_Manage_Login(res.data)
                this.NotifySuccess('You have successfully logged into your account');
                return this.$router.push({name:'dashboard'})
            }).catch(error => {
                if (error.response.status === 401) {
                    this.loading = false;
                    return this.NotifyError("email or password is wrong")
                }
                if (error.response.status === 422) {
                    this.errors = error.response.data
                    this.loading = false;

                }
            })

        }
    },
    name: "Manage_Auth"
}
</script>

<style scoped>

.top-img{

    width: 320px !important;

}

</style>
