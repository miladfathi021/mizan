<template>
    <div class="register-login">
        <div class="register-login__wrapper">
            <span @click="closeRegisterLoginComponent" class="register-login__close">
                <i class="las la-times-circle"></i>
            </span>
            <div class="register-login__logo">
                <img src="/images/main/logo.svg" alt="Logo Mizan">
            </div>
            <h4>ورود / ثبت نام</h4>
            <div class="register-login__card">
                <form>
                    <div class="form-group">
                        <label for="phone">شماره موبایل</label>
                        <input type="tel" id="phone" v-model="phone"/>
                    </div>

                    <div class="form-group">
                        <button>ورود</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RegisterLogin",
        data () {
            return {
                phone: '',
            }
        },
        methods: {
            closeRegisterLoginComponent () {
                this.$store.dispatch('showRegisterLogin/hide');
            }
        }
    }
</script>

<style scoped>

</style>
