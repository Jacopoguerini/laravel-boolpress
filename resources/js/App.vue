<template>
    <div>

        <Header />

        <main class="container my-3">
            <h1>Titolo del Blog</h1>
            <div class="row">

                <Card
                v-for="post in posts" :key="post.id"
                :item="post" />

                <!-- <div 
                class="col-4 my-2"
                v-for="post in posts" :key="post.id">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ post.title }}</h4>
                            <p>{{ truncateText(post.content, 150) }}</p>
                            <a href="#" class="card-link">Continua...</a>
                        </div>
                    </div>            
                </div> -->
            </div>
        </main>

        <Footer />
    </div>
</template>

<script>
import Header from './components/Header';
import Card from './components/Card';
import Footer from './components/Footer';

export default {
    name: 'App',
    data: function() {
        return {
            posts: []
        }
    },
    components: {
        Header,
        Card,
        Footer
    },
    methods: {
        truncateText: function(string, charsNumber = 100) {
            if(string.length > charsNumber) {
                return string.substr(0, charsNumber) + '...';
            } else {
                return string;
            }
        },
        getPosts: function() {
            axios
            .get('http://127.0.0.1:8000/api/posts')
            .then(
                res => {
                    console.log(res.data);
                    this.posts = res.data;

                    this.posts.forEach(
                        element => {
                        element.excerpt = this.truncateText(element.content, 150);
                    });
                }
            )
        .catch(
            err => {
                console.log(err);
            }
        );
        }
    },
    created: function() {
        this.getPosts();
    }
}
</script>

<style lang="scss" scoped>
@import '../sass/front.scss';


</style>