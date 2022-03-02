<template>
    <div>
          <div class="overlay"></div>
        <div class="col-md-6 col-lg-6 col-11 mx-auto my auto search-place">
                    <div class="input-group  form-container">
                        <input type="text" name="search" class="form-control search-input" placeholder="Search Place" autofocus="autofucos" autocomplete="off" v-model="searchValue">
                        <span class="input-group-btn">
                            <button class="btn btn-search" @click="getDetails()">
                            <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
         </div>
       <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <!-- <div class="col-md-6 px-0"> -->
        <div class="current-info">
                
                <div class="place-container">
                    <div class="time-zone" id="time-zone">{{weather.name}}/ <span class="country">{{weather.country}}</span></div>
                </div>
                <div class="date-container">
                    <div class="time" id="time">
                       Population : <span>{{ weather.population }} </span>
                    </div>
                    <div class="time" id="sunset">
                      Sunset : {{weather.sunset }}
                    </div>
                    <div class="time" id="sunrise">
                      Sunrise : {{weather.sunrise }}
                    </div>
                </div>
            </div>
       </div>
       <div class="future-forecast p-md-5 mb-4">
            
            <div class="weather-forecast" id="weather-forecast" v-if="forcast.length > 0">
                
                <div class="weather-forecast-item" v-for="fore in forcast" :key="fore.id">
                    
                     <img v-bind:src="'http://openweathermap.org/img/wn/' + fore.icon" alt="weather icon" class="w-icon">
                        <div class="dat">{{ fore.date }}</div>
                        <div class="dat">{{ fore.time }}</div>
                        <div class="temp">{{ fore.temp_min }}</div>
                </div>
            </div>
        </div>

        <div class="album py-5 bg-dark">
            <div class="container marketing">
                  <div class="row" v-if="placeDetails.length > 0">
                      <div class="row featurette" v-for="detail in placeDetails" :key="detail.id">
                        <div class="col-md-7 order-md-2">
                            <h2 class="featurette-heading">{{detail.name}}</h2>
                            <p class="lead">Address: {{detail.formatted_address}}</p>
                            <div class="col-md-12 order-md-12 d-flex" v-if="detail.categories.length > 0">
                                <span v-for="category in detail.categories" :key="category.id">
                                <img  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" v-bind:src="category.icon.prefix+'120'+category.icon.suffix" width="50" height="50" alt="weather icon" >
                                </span>
                            </div>
                        </div>
                        <div class="col-md-5 order-md-1" v-if="detail.photos.length > 0">

                            <div class="col-md-12 order-md-12 d-flex" >
                            <div class="col-md-6 order-md-6">
                                <img  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" v-bind:src="detail.photos[0].prefix+'250x250'+detail.photos[0].suffix" width="250" height="500" alt="weather icon" >
                            </div>
                            <div class="col-md-6 order-md-6">
                                <img  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" v-bind:src="detail.photos[1].prefix+'250x250'+detail.photos[0].suffix"  width="250" height="500" alt="weather icon" >
                            </div>
                            </div>
                            <div class="col-md-12 order-md-12 large-imge">
                                <img  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" v-bind:src="detail.photos[2].prefix+'original'+detail.photos[0].suffix" alt="weather icon" >
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        </div>
                        
                  </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            searchValue: this.$route.params.search,
            weather : {}, 
            forcast : [], 
            placeDetails : [],

        }
    }, 
    created (){
        this.getDetails();
    }, 
    methods : {
    
        getDetails : function(){
           let url = "./place";

			axios
				.post(url,{"city": this.searchValue})
				.then(response => {
                    
					this.weather = response.data.weather.details;
                    this.forcast = response.data.weather.forecast;
                    this.placeDetails = response.data.details.details;
                    console.log(response.data.weather.details);
				})
				.catch(error => {
    
                    if(error.response.status != 200){
                        alert(error.response.data.error);
                        this.$router.push({
                            name: 'home'
                        });
                    }
                })
				.finally(() => {
					
				});
        }
    }
}
</script>