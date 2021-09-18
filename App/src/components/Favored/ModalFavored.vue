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
                        placeholder="Fulano da silva"
                        label="Qual o nome completo ou razão social do favorecido?"
                        ref="name"
                        :rules="[val =>  val != '' || 'informe o nome do favorecido']"
                        dense
                        />
            </div>

            <div class="col-3 q-pl-sm q-pt-sm">
              <q-input outlined
                        autofocus
                        :mask="favored.document.length < 15 ? '###.###.###-###': '##.###.###/####-##'"
                        v-model="favored.document"
                        label="Qual o CPF ou CNPJ"
                        maxlength="18"
                        ref="document"
                        :rules="[val =>  val != '' || 'Informe o documento do favorecido']"
                        dense
                        />
            </div>
          </div>

          <div class="row q-pt-sm">
            <div class="col-7 q-pt-sm ">
              <q-input outlined
                        autofocus
                        v-model="favored.email"
                        placeholder="fulano@beltrano.com"
                        label="Qual o e-mail do favorecido?"
                        ref="email"
                        :rules="[val =>  val != '' || 'Informe um email', validEmailForm]"
                        dense
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
                        emit-value
                        map-options
                        input-debounce="0"
                        @filter="filterBank"
                        label="Qual o banco do favorecido?"
                        dense
                        ref="bank"
                        :rules="[val =>  val != '' || 'Selecione um banco']" />
            </div>
            <div class="col-3 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.agency"
                        placeholder=""
                        label="Qual a agência?"
                        ref="agency"
                        :rules="[val => val != ''|| 'Informe a Agência', validAgencyBank]"
                        dense
                        />
            </div>
            <div class="col-2 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.agencyDigit"
                        placeholder=""
                        label="Dígito"
                        ref="agencyDigit"
                        :rules="[validAgencyDigit]"
                        dense
                        />
            </div>
          </div>

          <div class="row q-pt-sm">
            <div class="col-7 ">
              <q-select outlined
                        v-model="favored.accountType"
                        emit-value
                        :options="optionsTypeAccount"
                        label="Qual o tipo da conta?"
                        ref="accountType"
                        :rules="[validTypeAccount]"
                        dense/>
            </div>
            <div class="col-3 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.account"
                        placeholder=""
                        label="Qual a conta corrente?"
                        ref="account"
                        :rules="[validAccount]"
                        dense
                        />
            </div>
            <div class="col-2 q-pl-sm">
              <q-input outlined
                        autofocus
                        v-model="favored.accountDigit"
                        placeholder=""
                        label="Dígito"
                        ref="accountDigit"
                        :rules="[validAccountDigit]"
                        dense
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
            @click="save()"
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
import { validEmailForm } from '../../utils'
import { api } from 'boot/axios'
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
      validEmailForm,
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
    isFormValid(){
      this.$refs.name.validate()
      this.$refs.document.validate()
      this.$refs.email.validate()
      this.$refs.bank.validate()
      this.$refs.agency.validate()
      this.$refs.agencyDigit.validate()
      this.$refs.account.validate()
      this.$refs.accountDigit.validate()
      this.$refs.accountType.validate()

      const formValid = (this.$refs.name.hasError
                        || this.$refs.document.hasError
                        || this.$refs.email.hasError
                        || this.$refs.agency.hasError
                        || this.$refs.agency.hasError
                        || this.$refs.agencyDigit.hasError
                        || this.$refs.account.hasError
                        || this.$refs.accountDigit.hasError
                        || this.$refs.accountType.hasError)

      return !formValid;
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
            return v.label.toLowerCase().indexOf(val) > -1
            || v.value.toLowerCase().indexOf(val) > -1
          })
        })
    },
    validAgencyBank(val){
      const pattern = /^(?:^0*)[1-9][0-9]{0,3}$/;
      return pattern.test(val) || 'Formato inválido';
    },
    validAgencyDigit(val){
      const pattern = /^[xX0-9]{0,1}$/;
      return pattern.test(val) || 'Formato inválido';
    },
    validAccountDigit(val){
      if(val === '') return "Obrigatório"

      const pattern = /^[xX0-9]{0,1}$/;
      return pattern.test(val) || 'Formato inválido';
    },
    validAccount(val){
      const { bank } = this.favored
      const pattern = bank === '001' ? /^(?:^0*)[1-9][0-9]{0,7}$/ : /^(?:^0*)[1-9][0-9]{0,10}$/;
      return pattern.test(val) || 'Formato inválido';
    },
    validTypeAccount(typeAccount){
      const { bank } = this.favored

      //Se for banco do brasil, não pode permir o tipo da conta CONTA_FACIL
      if(!typeAccount) return "Informe o tipo da conta"

      if(bank === '001'){
        return typeAccount.value !== 'CONTA_FACIL'
                              || 'Para o Banco do Brasil não é permitido esse tipo de conta'
      }

      return true
    },
    save(){

      if(this.isFormValid()){
        console.log('VAI SALVAR O FAVORECIDO: ', this.favored)
        api.post('/api/favored', this.favored)
          .then(res => {
            console.log('Favored salvo: ', res)

            this.$q.notify({
              message: 'Favorecido salvo com sucesso!',
              position: 'top-right',
              type: 'positive'
            })

            this.$emit('savedFavored', this.favored)
          })
          .catch(err => {
            // console.log('Erro ao salvar dados no banco de dados: ', err.response.data)
            this.$q.notify({
                message: 'Erro ao salvar favorecido, por favor tente novamente',
                position: 'top-right',
                type: 'negative'
              })
          })

      }else{
        console.log('NÂO PASSOU NA VALIDAÇÂO')
      }

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
