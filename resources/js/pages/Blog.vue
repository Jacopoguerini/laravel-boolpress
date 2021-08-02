<template>
    <div class="my-4">
        <h1>Blog</h1>
        <div class="row">
            <Card
            v-for="post in posts" :key="post.id"
            :item="post" />

            <!-- Test iniziale senza componente -->
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
            <!-- Test iniziale senza componente -->
        </div>

        <div class="text-center my-3">

            <button :disabled="current_page == 1"
            class="btn btn-dark mr-2"
            @click="getPosts(current_page - 1)">
                Prev
            </button>

            <button 
            class="btn mr-2"
            :class="(n == current_page) ? 'btn-primary' : 'btn-dark'"
            v-for="n in last_page" :key="n"
            @click="getPosts(n)">
                {{ n }}
            </button>

            <button :disabled="current_page == last_page"
            class="btn btn-dark"
            @click="getPosts(current_page + 1)">
                Next
            </button>

        </div>
    </div>
</template>

<script>
import Card from '../components/Card';

export default {
    name: 'Blog',
    data: function() {
        return {
            posts: [],
            current_page: 1,
            last_page: 1
        }
    },
    components: {
        Card
    },
    methods: {
        truncateText: function(string, charsNumber = 100) {
            if(string.length > charsNumber) {
                return string.substr(0, charsNumber) + '...';
            } else {
                return string;
            }
        },
        getPosts: function(page = 1) {
            axios
            .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(
                res => {
                    // console.log(res.data);
                    this.posts = res.data.data;
                    this.current_page = res.data.current_page;
                    this.last_page = res.data.last_page;

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

<style>

</style>