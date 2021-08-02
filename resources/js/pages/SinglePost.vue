<template>
    <div class="my-4" v-if="post">
        <h1>{{ post.title }}</h1>

        <h3>
            <span class="badge badge-info">{{ post.category.name }}</span>
        </h3>

        <h5>
            <span class="badge badge-pill badge-dark mr-1"
            v-for="tag in post.tags"
            :key="`tag-${tag.id}`">
                {{ tag.name }}
            </span>
        </h5>

        <p class="my-3">{{ post.content }}</p>

        <router-link :to="{ name: 'blog' }" class="btn btn-secondary">Torna all'elenco dei post</router-link>
    </div>
    <Loader v-else />
</template>

<script>
import Loader from '../components/Loader';

export default {
    name: 'SinglePost',
    components: {
        Loader
    },
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