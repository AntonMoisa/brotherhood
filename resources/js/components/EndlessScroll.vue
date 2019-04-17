<template>
  <ul class="quotes__list" ref="quotes" @scroll="scroll">
    <li class="quotes__item quote" v-for="person in persons">
      <blockquote>
        <p>
          {{ person.text }}
        </p>
        <cite>
          {{ person.user.name }}
        </cite>
      </blockquote>
    </li>
  </ul>
</template>

<script>
import {eventSearch} from '../app'

  export default {
    props:['project'],
    data() {
      return {
        persons: [],
        country: '',
      }
    },
    methods: {
      getInitialUsers() {
        axios.get('/project/'+ this.project + '/loadpost'
                ,                { params: {  country: this.country }}
                )
          .then(response => {
            for (var i = 0; i < response.data.length; i++) {
              this.persons.push(response.data[i])
            }
          })
      },
      scroll() {
        let block = this.$refs.quotes;
        let last = block.lastChild;

        let blockSize = block.scrollTop + block.offsetHeight + block.offsetTop;
        let lastSize = last.offsetTop + last.offsetHeight;

        if (blockSize >= lastSize) {
          let country = $('.search-form input').val();
          // let country = document.querySelector('.search-form input');
          // console.log(country);

          axios.get('/project/'+ this.project + '/loadpost', { params: { personsLength: this.persons.length, country: country } })
            .then(response => {
              for (var i = 0; i < response.data.length; i++) {
                this.persons.push(response.data[i])
              }
            })
        }
      },
    },
    beforeMount() {
      this.getInitialUsers();
    },
    mounted() {
      this.scroll();
    },
    created() {
      eventSearch.$on('updateData', (country) => {
        this.country = country;
        this.persons = [];
        this.getInitialUsers();
      })
    },
  }

</script>
