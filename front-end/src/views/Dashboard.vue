<template>
    <div class="home-container">
        <header class="home-header">
            <h1>Welcome to My Vue App</h1>
            <p>This is the homepage built with Vue 3 + Vite + Vue Router.</p>
            <router-link to="/about" class="btn">Go to About Page</router-link>
        </header>

        <section class="features">
            <div
                class="feature"
                v-for="(feature, index) in features"
                :key="index"
            >
                <h3>{{ feature.title }}</h3>
                <p>{{ feature.description }}</p>
            </div>
        </section>
    </div>
</template>

<script setup></script>
