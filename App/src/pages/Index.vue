<template>
  <q-page class="flex row">
    <div class="col-12 q-pl-xl q-pr-xl">
      <list-favored />
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import ListFavored  from '../components/Favored/List'

export default defineComponent({
  name: 'PageIndex',
  components:{
    ListFavored,
  },
  data(){
    return {
      search:''
    }
  },
  computed: {

  },
  methods: {
    handlleClickAddFavored(){
      this.openModalFavored = true
    }
  }
})
</script>
