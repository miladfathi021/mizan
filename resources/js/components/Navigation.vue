<template>
    <div class="navigation" :class="{'navigation--scroll': changeScrollPosition > 80}">
        <div class="container">
            <div class="navigation__content">
                <div class="navigation__logo">
                    <router-link to="/">
                        <img class="navigation__logo" src="/images/main/logo.svg" alt="میزان">
                    </router-link>
                </div>
                <ul class="navigation__items">
                    <li class="navigation__item"><a href="/">مشاوره متنی</a></li>
                    <li class="navigation__item"><a href="/">مشاوره تلفنی</a></li>
                    <li class="navigation__item"><a href="/">بلاگ</a></li>
                    <li class="navigation__item" v-if="user == null"><a @click.prevent="showLoginPage">ورود / ثبت نام</a></li>
                    <li class="navigation__item" v-else><a @click.prevent="">میلاد</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                changeScrollPosition: null,
                showLoginAndRegisterPage: false,
                user: null
            }
        },
        methods: {
            changeNavigation () {
                this.changeScrollPosition = window.scrollY;
            },
            showLoginPage () {
                this.showLoginAndRegisterPage = true;
            }
        },
        mounted () {
            window.addEventListener('scroll', this.changeNavigation);
        }
    }
</script>
