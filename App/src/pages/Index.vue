<template>
  <q-page class="flex row">
    <div class="col-12 q-pl-xl q-pr-xl">
      <q-card class="flat bordered no-shadow">
        <q-card-section class="bg-primary text-white">
          <div class="text-h6">Seus Favorecidos</div>
        </q-card-section>

        <q-separator />

        <q-card-section class="bg-blue-grey-1">
          <div class="row q-pa-lg">
              <div class="col-9">
                <div>
                  <span class="text-blue-grey-6 text-h5">Seus favorecidos </span>
                  <q-btn round
                  color="primary"
                  icon="add"
                  @click="handlleClickAddFavored" />
                </div>
              </div>
              <div class="col-3">
                <q-input outlined
                        autofocus
                        bg-color="white"
                        v-model="search" placeholder="Nome, CPF, Agência ou Conta"  :dense="true">
                      <template v-slot:append>
                    <q-btn round dense flat icon="search" />
                  </template>
                </q-input>
              </div>
          </div>
        </q-card-section>
      </q-card>
      <list-favored />
    </div>
    <!--<modal-favored :openModalFavored="openModalFavored"
                      @closeModal="openModalFavored = $event"/> -->
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import ListFavored  from '../components/Favored/List'
import ModalFavored from '../components/Favored/ModalFavored';

export default defineComponent({
  name: 'PageIndex',
  components:{
    ListFavored,
    ModalFavored
  },
  data(){
    return {
      search:'',
      openModalFavored: false
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
