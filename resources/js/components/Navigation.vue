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
                    <li class="navigation__item" v-if="user == null"><a @click.prevent="showRegisterLoginComponents">ورود / ثبت نام</a></li>
                    <li class="navigation__item" v-else><a @click.prevent=""><i class="las la-user" style="margin-left:.5rem;"></i>{{ user.name}}<i class="las la-angle-down" style="margin-right:1rem;"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        data () {
            return {
                changeScrollPosition: null,
                showLoginAndRegisterPage: false,
            }
        },
        methods: {
            changeNavigation () {
                this.changeScrollPosition = window.scrollY;
            },
            showRegisterLoginComponents () {
                this.$store.dispatch('showRegisterLogin/show');
            }
        },
        computed: {
          ...mapGetters('user', {user: 'user'}),
        },
        mounted () {
            window.addEventListener('scroll', this.changeNavigation);
        }
    }
</script>
