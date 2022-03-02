<template>
    <div class="">
        <div class="overlay"></div>
        <div class="col-md-6 col-lg-6 col-11 mx-auto my auto cover-box">
            <h1>Japan Tourist Guide</h1>
        </div>
        <div class="col-md-6 col-lg-6 col-11 mx-auto my auto search-box">
            <div class="input-group  form-container">
                <input type="text" name="search" class="form-control search-input" placeholder="Search Place" autofocus="autofucos" autocomplete="off" v-model="search">
                <span class="input-group-btn">
                    <button class="btn btn-search" @click="searchPlace()">
                       <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-11 mx-auto my auto cover-extra-box">
            <p class="lead">"The Biggest Adventure you can take is to  Live the Life of your Dreams"</p>
            <p class="lead"></p>
        </div>
    </div>
</template>
<script>
export default {
     data(){
        return {
            search : null
        }
    },
    methods : {
        searchPlace : function(){

            this.$router.push({
                name: 'place', 
                params: {
                    search: this.search,
                }
            });
        }
    }
}
</script>