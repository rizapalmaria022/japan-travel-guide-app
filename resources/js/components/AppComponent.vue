<template>
    <div >
        <header class="blog-header py-4">
            <div>
                <h3 class="float-md-start mb-0">Japan</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <router-link class="nav-link" aria-current="page" :to="{ name: 'home' }" :class="{active: $route.name==='home'}" >Home</router-link>
                    <router-link class="nav-link" :to="{ name: 'place' }" :class="{active: $route.name==='place'}">Place To Go</router-link>
                    
                </nav>
            </div>
        </header>
        <main class="container">
        <router-view></router-view>
        </main> 
    </div>
</template>

