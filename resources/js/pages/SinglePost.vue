<template>
    <div class="my-4">
        <h1>{{ post.title }}</h1>
        <p class="my-3">{{ post.content }}</p>

        <router-link :to="{ name: 'blog' }" class="btn btn-secondary">Torna all'elenco dei post</router-link>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data: function() {
        return {
            post: null
        }
    },
    created: function() {
        this.getPosts(this.$route.params.slug)
    },
    methods: {
        getPosts: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/posts/${slug}`)
                .then(
                    res => {
                        this.post = res.data;
                    }
                )
                .catch(
                    err => {
                        console.log(err);
                    }
                );
        }
    }
}
</script>

<style>

</style>