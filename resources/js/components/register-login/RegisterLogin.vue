<template>
    <div class="register-login" >
        <div class="register-login__wrapper" v-click-outside="{ ref: 'register-login', method: 'closeEvent' }">
            <span @click="closeRegisterLoginComponent" class="register-login__close">
                <i class="las la-times-circle"></i>
            </span>
            <div class="register-login__logo">
                <img src="/images/main/logo.svg" alt="Logo Mizan">
            </div>
            <div v-if="operationType === 'current'">
                <h4>ورود / ثبت نام</h4>
                <div class="register-login__card">
                    <form>
                        <div class="form-group">
                            <label for="phone">شماره موبایل</label>
                            <input type="tel" id="phone" v-model="phone"/>
                            <p class="feedback feedback--danger" v-if="errors.has('phone')">{{ errors.get('phone') }}</p>
                        </div>

                        <div class="form-group">
                            <button @click.prevent="checkIfUserExistOrNot">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
            <verification-code v-if="operationType === 'code'" :phone="phone" :message="message"></verification-code>

            <login v-if="operationType === 'password'" :phone="phone" :message="message"></login>
        </div>
    </div>
</template>

<script>
    import VerificationCode from "./VerificationCode";
    import Errors from '../../helpers/Errors';
    import Login from "./Login";

    export default {
        name: "RegisterLogin",
        components: { Login, VerificationCode },

        data () {
            return {
                phone: '',
                type: 'current',
                message: '',
                errors: new Errors(),
            }
        },

        computed: {
            operationType () {
                return this.type;
            }
        },

        methods: {
            closeRegisterLoginComponent () {
                this.$store.dispatch('showRegisterLogin/hide');
            },
            checkIfUserExistOrNot () {

                let regex = /^[0][9]\d{9}$/;

                this.errors = new Errors();

                if (regex.test(this.phone)) {
                    axios.post('/api/v1/phone-verification', {
                        phone: this.phone,
                    }).then(response => {
                        this.type = response.data.next;
                        this.message = response.data.message;
                    }).catch(error => {
                        this.errors.records(error.response.data.errors);
                    })
                } else {
                    this.errors.records({phone: {0: 'شماره موبایل صحیح نمی باشد.'} });
                }
            },
            closeEvent () {
                this.$store.dispatch('showRegisterLogin/hide');
            }
        }
    }
</script>

<style scoped>

</style>
