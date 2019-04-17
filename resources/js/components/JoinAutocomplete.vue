<template>
  <p class="join-form__block">
    <label aria-label="Поле ввода страны, обязательно для заполнения">
      <input class="join-form__field" name="country" type="text" placeholder="Страна*:" required v-model="queryString" @keyup="getResult">
    </label>
    <ul class="join-form__result" v-if="countries.length">
      <li class="join-form__result-item" v-for="country in countries" :key="country" @click="selectCountry($event)"> {{country}} </li>
    </ul>
  </p>
</template>

<script>
  export default {
    data() {
      return {
        queryString: '',
        countries: []
      }
    },
    methods: {
      getResult() {
        let language = $('.languages-form__field option:checked').val();

        this.countries = [];

        axios.get('/language', { params: { queryString: this.queryString, language: language } }).then(response => {
          response.data.forEach((country) => {
            this.countries.push(country);
          });
        })
      },
      selectCountry(event) {
        this.queryString = event.target.innerHTML
        this.countries = []
      }
    }
  }

</script>
