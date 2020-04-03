<template>
    <div>
        <h4>ثبت نام</h4>
        <p v-text="message"></p>
        <div class="register-login__card">
            <form>
                <div class="form-group">
                    <label for="phone">شماره موبایل</label>
                    <input type="tel" id="phone" v-model="phone" disabled/>
                    <p class="feedback feedback--danger" v-if="errors.has('phone')">{{ errors.get('phone') }}</p>

                </div>

                <div class="form-group">
                    <label for="name">نام و نام خانوادگی <span class="description">( لطفا فارسی بنویسید )</span></label>
                    <input type="text" id="name" v-model="name"/>
                    <p class="feedback feedback--danger" v-if="errors.has('name')">{{ errors.get('name') }}</p>

                </div>

                <div class="form-group">
                    <label for="password">کلمه عبور</label>
                    <input type="password" id="password" @keypress="justEnglish" v-model="password"/>
                    <p class="feedback feedback--danger" v-if="errors.has('password')">{{ errors.get('password') }}</p>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تکرار کلمه عبور</label>
                    <input type="password" id="password_confirmation" @keypress="justEnglish" v-model="password_confirmation"/>
                </div>

                <div class="form-group">
                    <button @click.prevent="register">ثبت نام</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Errors from "../../helpers/Errors";
    import Cookie from "../../helpers/cookies";

    export default {
        name: "Register",
        props: ['phone', 'message'],

        data () {
            return {
                name: null,
                password: null,
                password_confirmation: null,
                errors: new Errors(),
            }
        },

        methods: {
            register () {
                axios.post('/api/v1/register', {
                    phone: this.phone,
                    name: this.name,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                }).then(response => {
                    let cookie = new Cookie();
                    cookie.setCookie('user', response.data.user, {'max-age': 30 * 24 * 60 * 60 * 1000});
                    this.$store.dispatch('user/setUser', response.data.user);
                    this.$store.dispatch('showRegisterLogin/hide');
                }).catch(error => {
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
        },

    }
</script>

<style scoped>

</style>
