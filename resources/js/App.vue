<template>
    <div>

        <Header />

        <main class="container my-3">
            <router-view></router-view>
        </main>

        <Footer />
    </div>
</template>

<script>
import Header from './components/Header';
import Footer from './components/Footer';

export default {
    name: 'App',
    data: function() {
        return {
            posts: [],
            current_page: 1,
            last_page: 1
        }
    },
    components: {
        Header,
        Footer
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = "Boolpress | " + to.meta.title;
            }
        }
    }
} 
</script>

<style lang="scss" scoped>
@import '../sass/front.scss';


</style>