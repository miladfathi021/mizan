<template>
    <div class="home-page">
        <header>
            <div class="header">
                <h1>"میزان" پشتیبان مشکلات حقوقی شما</h1>
                <p>در هر زمان و مکان با وکلای متخصص در ارتباط باشید</p>

                <form class="header__search" action="/search" method="GET">
                    <input type="text" class="header__search--inputs" name="search" autocomplete="off" placeholder="جستجوی وکیل , تخصص">
                    <button class="header__search--btn-search"><i class="las la-search"></i></button>
                </form>
            </div>
        </header>
        <main>
            <div class="container">
                <section class="story">

                    <div class="story__user">
                        <img src="/images/main/user-laptop.svg" alt="user">
                    </div>

                    <div class="story__lawyer">
                        <img src="/images/main/lawyer.svg" alt="lawyer">
                    </div>
                </section>

                <section class="services">
                    <h2>خدماتی که "میزان" به شما ارائه می دهد</h2>

                    <div class="services__wrapper">
                        <div class="card">
                            <div class="card__service">
                                <div class="card__service--image">
                                    <img src="/images/main/chat.svg" alt="chat">
                                </div>
                                <h3>گفتگوی آنلاین</h3>
                                <p>متنی و تلفنی</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__service">
                                <div class="card__service--image">
                                    <img src="/images/main/date.svg" alt="date">
                                </div>
                                <h3>نوبت دهی آنلاین</h3>
                                <p>رزرو تاریخ و ساعت</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__service">
                                <div class="card__service--image">
                                    <img src="/images/main/map.svg" alt="map">
                                </div>
                                <h3>بانک دفاتر</h3>
                                <p>اطلاعات دفاتر و دادگستری ها</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__service">
                                <div class="card__service--image">
                                    <img src="/images/main/knowledge.svg" alt="knowledge">
                                </div>
                                <h3>دانستنی ها</h3>
                                <p>اطلاعات و قوانین</p>
                            </div>
                        </div>
                    </div>

                </section>

                <section class="lawyers">
                    <h2>وکلای متخصص آماده ارائه مشاوره به شما</h2>
                    <p>گفتگوی متنی و تلفنی با مشاورین با حفظ حریم شخصی</p>

                    <div class="lawyers__wrapper">
                        <div class="card">
                            <div class="card__lawyers">
                                <h3>آقای میلاد فتحی</h3>
                                <div class="card__lawyers--image">
                                    <img src="/images/main/user-1.jpeg" alt="user">
                                </div>
                                <div class="card__lawyers--score">
                                    <i class="las la-star"></i> <span>4.97</span>
                                </div>
                                <div class="card__lawyers--consultation">
                                    <a href="/">دریافت مشاوره</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__lawyers">
                                <h3>آقای کاوه علی پناه</h3>
                                <div class="card__lawyers--image">
                                    <img src="/images/main/user-2.jpeg" alt="user">
                                </div>
                                <div class="card__lawyers--score">
                                    <i class="las la-star"></i> <span>4.97</span>
                                </div>
                                <div class="card__lawyers--consultation">
                                    <a href="/">دریافت مشاوره</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__lawyers">
                                <h3>آقای رامان بهمنی</h3>
                                <div class="card__lawyers--image">
                                    <img src="/images/main/user-3.jpeg" alt="user">
                                </div>
                                <div class="card__lawyers--score">
                                    <i class="las la-star"></i> <span>4.97</span>
                                </div>
                                <div class="card__lawyers--consultation">
                                    <a href="/">دریافت مشاوره</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__lawyers">
                                <h3>خانم ثنا فتحی</h3>
                                <div class="card__lawyers--image">
                                    <img src="/images/main/user-4.jpeg" alt="user">
                                </div>
                                <div class="card__lawyers--score">
                                    <i class="las la-star"></i> <span>4.97</span>
                                </div>
                                <div class="card__lawyers--consultation">
                                    <a href="/">دریافت مشاوره</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__lawyers">
                                <h3>خانم ثنا فتحی</h3>
                                <div class="card__lawyers--image">
                                    <img src="/images/main/user-4.jpeg" alt="user">
                                </div>
                                <div class="card__lawyers--score">
                                    <i class="las la-star"></i> <span>4.97</span>
                                </div>
                                <div class="card__lawyers--consultation">
                                    <a href="/">دریافت مشاوره</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <section class="features">
                    <h3>ویژگی های "میزان" :</h3>
                    <ul>
                        <li>
                            <img src="/images/main/consultation.svg" alt="consultation">
                            <span>مشاوره با وکلای متخصص</span>
                        </li>

                        <li>
                            <img src="/images/main/privacy.svg" alt="privacy">
                            <span>حافظ حریم شخصی</span>
                        </li>

                        <li>
                            <img src="/images/main/time-money.svg" alt="time and money">
                            <span>صرفه جویی در زمان و هزینه</span>
                        </li>

                        <li>
                            <img src="/images/main/iran-map.svg" alt="map of iran">
                            <span>پوشش سراسری</span>
                        </li>
                    </ul>
                </section>

                <section class="registration">
                    <h3>به "میزان" بپیوندید</h3>
                    <div class="registration__wrapper">
                        <div class="registration__lawyer">
                            <div class="registration__lawyer--image">
                                <img src="/images/main/lawyer-register.svg" alt="lawyer">
                            </div>
                            <div class="registration__lawyer--text">
                                <h4>وکیل هستید؟</h4>
                                <p>شما هم با پیوستن به جمع بزرگ وکلای "میزان" حس خوب همدلی با کاربران را تجربه کنید</p>
                                <a href="/">ثبت نام وکیل</a>
                            </div>
                        </div>

                        <div class="registration__user">
                            <div class="registration__user--image">
                                <img src="/images/main/user-register.svg" alt="user">
                            </div>
                            <div class="registration__user--text">
                                <h4>کاربر هستید؟</h4>
                                <p>شما هم با عضویت در "میزان" از دریافت آنلاین خدمات لذت ببرید</p>
                                <a @click.prevent="showRegisterLoginComponents">ثبت نام کاربر</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <register-login v-if="showRegisterLogin" v-outside-click="{ method: 'closeEvent' }"></register-login>
    </div>
</template>

<script>
    import RegisterLogin from "../components/RegisterLogin";
    import { mapState } from "vuex";

    export default {
        name: "HomePage",
        components: {RegisterLogin},
        data () {
            return {

            }
        },

        computed: {
            ...mapState({
                showRegisterLogin: state => state.showRegisterLogin.show
            }),
        },

        methods: {
            showRegisterLoginComponents () {
                this.$store.dispatch('showRegisterLogin/show');
            },
            closeEvent () {
                console.log('close event called');
                this.$store.dispatch('showRegisterLogin/hide');
            }
        },
    }
</script>

<style scoped>

</style>
