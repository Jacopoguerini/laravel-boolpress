<template>
    <header class="bg-dark">
        <nav class="text-center navbar navbar-expand-lg navbar-dark bg-dark">
            <router-link :to="{ name: 'home' }" class="navbar-brand">Boolpress</router-link>

            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'blog' }" class="nav-link">Blog</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'about' }" class="nav-link">Chi siamo</router-link>
                    </li>                    
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header'

}
</script>

<style>

</style>