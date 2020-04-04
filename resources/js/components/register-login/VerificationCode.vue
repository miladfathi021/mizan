<template>
    <div>
        <div v-if="operationType === 'current'">
            <h4>تایید شماره موبایل</h4>
            <p v-text="msg_func"></p>
            <div class="register-login__card">
                <form>
                    <div class="form-group">
                        <label for="phone">شماره موبایل</label>
                        <input type="tel" id="phone" v-model="phone" disabled/>
                    </div>

                    <div class="form-group" v-if="expire">
                        <label class="left">
                            <a class="resend" @click="resendVerificationCode">ارسال مجدد</a>
                        </label>
                    </div>

                    <div class="form-group" v-if="!expired">
                        <label class="left">
                            <span class="resend">ارسال مجدد کد بعد از {{ timer }} ثانیه دیگر</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="code1">کد فعالسازی</label>
                        <div class="verification-code">
                            <input type="text" pattern="[0-9]{1}" id="code1" v-model="first_code" @keypress="justEnglish" @keyup="checkInput"/>
                            <input type="text" pattern="[0-9]{1}" id="code2" v-model="second_code" @keypress="justEnglish" @keyup="checkInput"/>
                            <input type="text" pattern="[0-9]{1}" id="code3" v-model="third_code" @keypress="justEnglish" @keyup="checkInput"/>
                            <input type="text" pattern="[0-9]{1}" id="code4" v-model="fourth_code" @keypress="justEnglish" maxlength="1" @keyup="accept"/>
                        </div>
                        <p class="feedback feedback--danger" v-if="errors.has('code')">{{ errors.get('code') }}</p>
                    </div>

                    <div class="form-group">
                        <button @click.prevent="accept" value="t">تایید</button>
                    </div>
                </form>
            </div>
        </div>

        <register v-if="operationType === 'register'" :phone="phone" :message="msg_func"></register>
    </div>
</template>

<script>
    import Register from "./Register";
    import Errors from '../../helpers/Errors';

    export default {
        name: "VerificationCode",
        components: { Register },
        props: ['phone', 'message'],

        data () {
            return {
                first_code: null,
                second_code: null,
                third_code: null,
                fourth_code: null,
                code: null,
                countDown_second: 59,
                countDown_minute: 1,
                type: 'current',
                msg: this.message,
                expired: false,
                errors: new Errors(),
            }
        },

        computed: {
            operationType () {
                return this.type;
            },

            msg_func () {
                return this.msg;
            },

            expire () {
                return this.expired;
            },
            timer () {
                let sec = this.countDown_second < 10 ? '0' + this.countDown_second : this.countDown_second;
                let min = this.countDown_minute < 10 ? '0' + this.countDown_minute : this.countDown_minute;
                return min + ':' + sec;
            }
        },

        created() {
            this.countDownTimer();
        },

        methods: {
            countDownTimer () {
                if (this.countDown_second + 1 > 0) {
                    setTimeout(() => {
                        this.countDown_second -= 1;
                        this.countDownTimer();
                    }, 1000);
                } else if (this.countDown_minute > 0){
                    this.countDown_second = 59;
                    this.countDown_minute -= 1;
                    this.countDownTimer();
                } else {
                    this.countDown_second = 0;
                    this.expired = true;
                }
            },

            accept ($event) {

                if ($event.target.value === '') {
                    return;
                }
                this.code = Number(this.first_code + this.second_code + this.third_code + this.fourth_code);
                axios.post('/api/v1/success-phone-verification', {
                    phone: this.phone,
                    code: this.code === 0 ? null : this.code,
                }).then(response => {
                    if (response.data.status === 200) {
                        this.type = response.data.next;
                        this.msg = response.data.message;
                    }
                }).catch(error => {
                    if (error.response.data.status === 401) {
                        if ('time' in error.response.data) {
                            this.expired = true;
                            this.msg = error.response.data.message;
                        }
                        this.errors.records({code: {0: error.response.data.message}});
                        return;
                    }
                    this.errors.records(error.response.data.errors);
                })
            },

            resendVerificationCode () {
                axios.post('/api/v1/phone-verification', {
                    phone: this.phone,
                }).then(response => {
                    if (response.data.status === 201) {
                        this.msg = response.data.message;
                        this.expired = false;
                        this.countDown_minute = 1;
                        this.countDown_second = 59;
                        this.countDownTimer();
                    }
                }).catch(error => {
                    console.log(error.response.data.errors);
                })
            },
            justEnglish ($event) {
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);

                // only allow number and one dot
                if ((keyCode < 48 || keyCode > 57)) {
                    this.errors.records({code: {0: 'زبان کیبورد را به انگلیسی تغییر دهید'}});
                    $event.preventDefault();
                    return;
                }

                this.errors = new Errors();

            },
            checkInput ($event) {
                if ($event.target.value !== '') {
                    $event.target.nextElementSibling.focus();
                }
            }
        }
    }
</script>

<style scoped>

</style>
