<template>
  <div class="q-pa-md q-gutter-sm">
    <q-dialog
      v-model="dialog"
      :persistent="false"
      :maximized="false"
      transition-show="slide-up"
      transition-hide="slide-down"
      class="md-favored"
    >
      <q-card style="width: 700px; max-width: 80vw;">
        <q-bar class="bg-primary">
          <q-space />
          <q-btn dense flat icon="close" v-close-popup color="white" size="lg">
            <q-tooltip>Close</q-tooltip>
          </q-btn>
        </q-bar>

        <q-card-section>
          <div class="text-h6">Quais os dados do favorecido?</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="row">
            <div class="col-8">
              <q-input outlined
                        autofocus
                        v-model="favored.name"
                        placeholder="Nome, CPF, Agência ou Conta"
                        label="Qual o nome completo ou razão social do favorecido?"
                        />
            </div>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { ref } from 'vue'


export default defineComponent({
  name:'modal-favored',
  props: ['openModalFavored'],
  data(){
    return {
      dialog: ref(true),
      maximizedToggle: ref(true),
      favored: {
        name: '',
        document: '',
        email: '',
        bank: '',
        agency: '',
        agencyDigit: '',
        account: '',
        accountDigit: '',
        accountType: '',
        valid: ''
      }

    }
  },
  watch: {
    openModalFavored(value){
      this.dialog = value
    },
    dialog(value){
      if(!value){
        this.$emit('closeModal', false)
      }
    }
  },

})


</script>
