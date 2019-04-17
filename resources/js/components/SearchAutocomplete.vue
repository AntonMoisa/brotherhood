<template>
  <form class="search-form" autocomplete="off">
    <p class="search-form__block">
      <label aria-label="Искать на странице">
        <input class="search-form__field" name="search" type="search" placeholder="Поиск" v-model="queryString" @keyup="getResult">
      </label>
      <button class="search-form__submit" aria-label="Поиск">
        <svg class="search-form__submit-img" role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 30.239 30.239">
          <path d="M20.194,3.46c-4.613-4.613-12.121-4.613-16.734,0c-4.612,4.614-4.612,12.121,0,16.735   c4.108,4.107,10.506,4.547,15.116,1.34c0.097,0.459,0.319,0.897,0.676,1.254l6.718,6.718c0.979,0.977,2.561,0.977,3.535,0   c0.978-0.978,0.978-2.56,0-3.535l-6.718-6.72c-0.355-0.354-0.794-0.577-1.253-0.674C24.743,13.967,24.303,7.57,20.194,3.46z    M18.073,18.074c-3.444,3.444-9.049,3.444-12.492,0c-3.442-3.444-3.442-9.048,0-12.492c3.443-3.443,9.048-3.443,12.492,0   C21.517,9.026,21.517,14.63,18.073,18.074z"></path>
        </svg>
      </button>
    </p>

    <p class="search-form__result" v-if="countries.length">
      <ul class="search-form__result-list">
        <li class="search-form__result-item" v-for="country in countries" @click="selectCountry($event)"> {{country}} </li>
      </ul>
    </p>
  </form>
</template>

<script>
import {eventSearch} from '../app'


  export default {
    props:['project'],
    data() {
      return {
        queryString: '',
        countries: []
      }
    },
    methods: {
      getResult() {
        this.countries = [];
        axios.get('/language', { params: { queryString: this.queryString } }).then(response => {
          response.data.forEach((country) => {
            this.countries.push(country);
          });
        })
        eventSearch.$emit('updateData', this.queryString);
      },
      selectCountry(event) {
        this.queryString = event.target.innerHTML;
        this.countries = [];
        eventSearch.$emit('updateData', this.queryString);
      }
    }
  }

</script>
