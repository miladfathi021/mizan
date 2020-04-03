<template>
    <div>
        <h4>ورود</h4>
        <p v-text="message"></p>
        <div class="register-login__card">
            <form>
                <div class="form-group">
                    <label for="phone">شماره موبایل</label>
                    <input type="tel" id="phone" v-model="phone" disabled/>
                    <p class="feedback feedback--danger" v-if="errors.has('phone')">{{ errors.get('phone') }}</p>

                </div>

                <div class="form-group">
                    <label for="password">کلمه عبور</label>
                    <input type="password" id="password" v-model="password" @keypress="justEnglish"/>
                    <p class="feedback feedback--danger" v-if="errors.has('password')">{{ errors.get('password') }}</p>
                </div>

                <div class="form-group">
                    <button @click.prevent="login">ورود</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Errors from "../../helpers/Errors";
    import Cookie from "../../helpers/cookies";

    export default {
        name: "Login",
        props: ['phone', 'message'],

        data () {
            return {
                password: null,
                errors: new Errors(),
            }
        },

        methods: {
            login () {
                axios.post('/api/v1/login', {
                    phone: this.phone,
                    password: this.password,
                }).then(response => {
                    let cookie = new Cookie();
                    cookie.setCookie('user', response.data.data, {'max-age': 30 * 24 * 60 * 60 * 1000});

                    this.$store.dispatch('user/setUser', response.data.data);
                    this.$store.dispatch('showRegisterLogin/hide');

                }).catch(error => {
                    if (error.response.status === 401) {
                        this.errors.records({phone: {0: error.response.data.message}});
                        return;
                    }
                    this.errors.records(error.response.data.errors);
                })
            },
            justEnglish ($event) {
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

                // only allow number and one dot
                if ((keyCode < 48 || keyCode > 57)) {
                    this.errors.records({password: {0: 'زبان کیبورد را به انگلیسی تغییر دهید'}});
                    $event.preventDefault();
                    return;
                }

                this.errors = new Errors();

            },
        }
    }
</script>

<style scoped>

</style>
