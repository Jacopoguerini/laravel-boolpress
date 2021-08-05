<template>
    <div class="my-4" v-if="post">
        <h1>{{ post.title }}</h1>

        <div class="h4" v-if="post.category">
            <router-link class="badge badge-primary" :to="{ name: 'category', params: { slug: post.category.slug } }">
                {{ post.category.name }}
            </router-link>
        </div>

        <router-link
            class="badge badge-pills badge-info mr-2 mb-3"
            v-for="tag in post.tags" :key="`tag-${tag.id}`"
            :to="{ name: 'tag', params: { slug: tag.slug } }">
                {{ tag.name }}
        </router-link>

        <img class="img-fluid rounded mx-auto d-block" style="width: 800px" :src="post.cover" :alt="post.title">

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