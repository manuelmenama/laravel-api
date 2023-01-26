<script>

import axios from 'axios';

export default {
  name: 'App',
  data(){
    return {
      baseUrl: 'http://127.0.0.1:8000/api/',
      projects: [],
      contentMaxLengt: 150,
      pagination: {
        current: 1,
        last: null
      }
    }
  },
  methods:{
    getApi(pageNumber){

      this.pagination.current = pageNumber;
      axios.get(this.baseUrl + 'projects',{
        params: {
            page: this.pagination.current
        }
      })
        .then(result => {
          this.projects = result.data.projects.data;
          this.pagination.current = result.data.projects.current_page;
          this.pagination.last = result.data.projects.last_page;
          console.log(this.projects);
        })
    },
    shorterText(text){
      if(text.length < this.contentMaxLengt){
        return text.substring(0, this.contentMaxLengt) + '...';
      }
      return text;
    }
  },
  mounted(){
    this.getApi(1);
  }
}
</script>

<template>
  <div class="container">

    <h1>Chiamata axios from vue</h1>

    <div class="card-wrapper">

      <div
        class="card"
        v-for="project in projects"
        :key="project.id">
        <h3>{{ project.name }}</h3>
        <div v-html="shorterText(project.summary)">
        </div>
      </div>

    </div>

    <div class="paginator">
        <button
            :disabled="pagination.current === 1"
            @click="getApi(pagination.current - 1)">
            &larr;
        </button>
        <button
            v-for="i in pagination.last"
            :key="i"
            :disabled="pagination.current === i"
            @click="getApi(i)">
            {{ i }}
        </button>
        <button
            :disabled="pagination.current === pagination.last"
            @click="getApi(pagination.current + 1)">
            &rarr;
        </button>
    </div>
  </div>


</template>


<style lang="scss">

@use '../scss/appVue.scss';

</style>
