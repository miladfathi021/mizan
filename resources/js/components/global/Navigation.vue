<template>
    <nav class="navigation" :class="{'navigation--scroll': changeScrollPosition > 80}">
        <div class="container">
            <div class="navigation__content">
                <div class="navigation__logo">
                    <router-link to="/">
                        <img class="navigation__logo" src="/images/main/logo.svg" alt="میزان">
                    </router-link>
                </div>
                <ul class="navigation__items">
                    <li class="navigation__item">
                        <router-link to="/">مشاوره متنی</router-link>
                    </li>

                    <li class="navigation__item">
                        <router-link to="/phone-call-consultancy">
                            <a href="/">مشاوره تلفنی</a>
                        </router-link>
                    </li>

                    <li class="navigation__item">
                        <a href="/">بلاگ</a>
                    </li>

                    <li class="navigation__item" v-if="user == null">
                        <a id="register-login" @click.prevent="showRegisterLoginComponents">ورود / ثبت نام</a>
                    </li>

                    <li class="navigation__item" v-else>
                        <a id="user-login-dropdown" @click.prevent="userLoginDropDown">
                            <i id="user-login-dropdown" class="las la-user"></i>
                            <span id="user-login-dropdown">{{ user.name }}</span>
                            <i id="user-login-dropdown" class="las la-angle-down"></i>
                        </a>
                        <ul v-if="showUserLoginDropDown" v-click-outside="{ ref: 'user-login-dropdown', method: 'userLoginDropDown' }" class="navigation__user-login">
                            <li class="navigation__user-login--item"><a>{{ user.name }}</a></li>
                            <li class="navigation__user-login--logout"><a @click.prevent="logout">خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Cookie from "../../helpers/cookies";

    export default {
        data () {
            return {
                changeScrollPosition: null,
                showLoginAndRegisterPage: false,
                showUserLoginDropDown: false,
            }
        },
        methods: {
            changeNavigation () {
                this.changeScrollPosition = window.scrollY;
            },
            showRegisterLoginComponents () {
                this.$store.dispatch('showRegisterLogin/show');
            },
            userLoginDropDown () {
                this.showUserLoginDropDown = !this.showUserLoginDropDown;
            },
            logout () {
                let cookies = new Cookie();
                cookies.deleteCookie('user');
                location.reload();
            }
        },
        computed: {
            ...mapGetters({
                user: 'user/user',
            })
        },

        mounted () {
            window.addEventListener('scroll', this.changeNavigation);
        }
    }
</script>
