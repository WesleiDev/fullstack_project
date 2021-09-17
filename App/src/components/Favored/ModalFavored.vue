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
      <q-card style="width: 860px; max-width: 95vw;">
        <q-bar class="bg-primary">
          <q-space />
          <q-btn dense flat icon="close" v-close-popup color="white" size="lg">
            <q-tooltip>Close</q-tooltip>
          </q-btn>
        </q-bar>

        <q-card-section>
          <div class="text-h5">Quais os dados do favorecido?</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="row">
            <div class="col-7 q-pt-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.name"
                        placeholder="Nome, CPF, Agência ou Conta"
                        label="Qual o nome completo ou razão social do favorecido?"
                        />
            </div>

            <div class="col-3 q-pl-sm q-pt-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.document"
                        label="Qual o CPF ou CNPJ"

                        />
            </div>
          </div>

          <div class="row q-pt-md">
            <div class="col-7 q-pt-sm ">
              <q-input outlined
                        autofocus
                        v-model="favored.email"
                        placeholder="fulano@beltrano.com"
                        label="Qual o e-mail do favorecido?"
                        />
            </div>
          </div>

          <q-card-section>
            <div class="text-h5">Quais os dados bancários do favorecido?</div>
          </q-card-section>

          <div class="row q-pt-sm">
            <div class="col-7 ">
              <q-select outlined
                        v-model="favored.bank"
                        :options="optionsBank"
                        use-input
                        input-debounce="0"
                        @filter="filterBank"
                        label="Qual o banco do favorecido?" />
            </div>
            <div class="col-3 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.agency"
                        placeholder=""
                        label="Qual a agência?"
                        />
            </div>
            <div class="col-2 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.agencyDigit"
                        placeholder=""
                        label="Dígito"
                        />
            </div>
          </div>

          <div class="row q-pt-md">
            <div class="col-7 ">
              <q-select outlined
                        v-model="favored.accountType"
                        :options="optionsTypeAccount"
                        label="Qual o tipo da conta?" />
            </div>
            <div class="col-3 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.account"
                        placeholder=""
                        label="Qual a conta corrente?"
                        />
            </div>
            <div class="col-2 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.accountDigit"
                        placeholder=""
                        label="Dígito"
                        />
            </div>
          </div>

          <div class="row q-pt-md content-buttons-footer-md-favored">
            <q-btn class="btn-cancel"
            color="primary"
            label="Cancelar"
            no-caps
            outline
            v-close-popup
            />

            <q-btn class="btn-save"
            color="secondary"
            label="Salvar"
            no-caps
            v-close-popup
             />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { ref } from 'vue'
require('./styles.css')

const optionsBank = [
  {label: 'Banco do Brasil (001)', value: '001'},
  {label: 'Bradesco (237)', value: '237'},
  {label: 'Caixa Econômica do Federal (104)', value: '104'},
  {label: 'Sicoob (756)', value: '756'},
];

const optionsTypeAccount = [
  {label: 'Conta Corrente', value: 'CONTA_CORRENTE'},
  {label: 'Conta Poupança', value: 'CONTA_POUPANCA'},
  {label: 'Conta Fácil', value: 'CONTA_FACIL'},
];

export default defineComponent({
  name:'modal-favored',
  props: ['openModalFavored'],
  data(){
    return {
      dialog: ref(false),
      maximizedToggle: ref(true),
      optionsBank,
      optionsTypeAccount,
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
        valid: false
      }

    }
  },
  methods: {
    newFavored(){
      return {
        name: '',
        document: '',
        email: '',
        bank: '',
        agency: '',
        agencyDigit: '',
        account: '',
        accountDigit: '',
        accountType: '',
        valid: false
      }
    },
    filterBank(val, update){

      if (val === '') {
          update(() => {
            this.optionsBank = optionsBank
          })
          return
        }

        update(() => {
          this.optionsBank = optionsBank.filter((v) => {
            return v.label.toLowerCase().indexOf(needle) > -1
            || v.value.toLowerCase().indexOf(needle) > -1
          })
        })
    }
  },
  watch: {
    openModalFavored(value){
      this.dialog = value
    },
    dialog(value){
      if(!value){
        this.favored = this.newFavored()
        this.$emit('closeModal', false)
      }
    }
  },

})


</script>
