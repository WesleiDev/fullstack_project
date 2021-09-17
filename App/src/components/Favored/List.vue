<template>

  <div>
    <q-card class="flat bordered no-shadow">
        <q-card-section class="bg-primary text-white">
          <div class="text-h6">Seus Favorecidos</div>
        </q-card-section>

        <q-separator />

        <q-card-section class="bg-blue-grey-1">
          <div class="row q-pa-lg">
              <div class="col-9">
                <div>
                  <span class="text-blue-grey-6 text-h5">Seus favorecidos {{dataPaginate}} </span>
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
                        v-model="search"
                        placeholder="Nome, CPF, Agência ou Conta"
                        :dense="true">
                      <template v-slot:append>
                    <q-btn round dense flat icon="search" />
                  </template>
                </q-input>
              </div>
          </div>
        </q-card-section>
      </q-card>
      <div class="row q-pl-lg q-pt-lg">
        <q-btn label="Excluir selecionados"
        color="pink-3"
        no-caps
        size="md"
        padding="md"
        :disable="!selected.length"
        />

      </div>
    <div class="col-12">
      <div class="q-pt-md">
        <q-table
          separator="none"
          title="Favorecidos"
          :rows="rows"
          :columns="columns"
          row-key="name"
          selection="multiple"
          v-model:selected="selected"
          id="table-results"
          v-model:pagination="pagination"
          hide-pagination
          class="no-shadow q-pl-lg q-pr-lg"
        >

          <template v-slot:body="props">
            <q-tr :props="props" @click="handleClickRowTable">
              <q-td>
                <q-checkbox v-model="props.selected"/>
              </q-td>
              <q-td key="name" :props="props">
                {{ props.row.name }}
              </q-td>
              <q-td key="document" :props="props">
                {{ props.row.document }}
              </q-td>
              <q-td key="bank" :props="props">
                <img :src="getLogoBank(props.row.bank)" class="img-logo-bank-list"/>
              </q-td>
              <q-td key="agency" :props="props">
                {{ props.row.agency }}
              </q-td>
              <q-td key="account" :props="props">
                {{ props.row.account }}
              </q-td>
              <q-td key="valid" :props="props">
                <q-badge
                  rounded
                  :color=" props.row.valid ? 'light-blue-8' : 'blue-grey-6'"
                  :label="props.row.valid ? 'Validado': 'Rascunho'"
                  class="status-favored-table" />
              </q-td>
            </q-tr>
          </template>
        </q-table>
        <div class="row justify-center q-mt-md">
          <q-pagination
            v-model="pagination.page"
            color="grey-8"
            :max="pagesNumber"
            size="sm"
          />
        </div>
      </div>
    </div>
    <modal-favored :openModalFavored="openModalFavored"
                      @closeModal="openModalFavored = $event"/>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { ref } from 'vue';
import ModalFavored from './ModalFavored';

require('./styles.css')

const columns = [
  {
    name: 'name',
    required: true,
    label: 'Nome',
    align: 'left',
    field: row => row.name,
    classes: 'row-table',
    headerClasses: 'title-table'
  },
  { name: 'document', align: 'left', label: 'CPF / CNPJ', field: 'document', headerClasses: 'title-table', classes: 'row-table',  },
  { name: 'bank', align: 'left',label: 'Banco', field: 'bank', headerClasses: 'title-table', classes: 'row-table', },
  { name: 'agency',align: 'left', label: 'Agência', field: 'agency', headerClasses: 'title-table', classes: 'row-table', },
  { name: 'account',align: 'left', label: 'CC', field: 'account', headerClasses: 'title-table', classes: 'row-table', },
  { name: 'valid',align: 'center', label: 'Status do Favorecido', field: 'valid', headerClasses: 'title-table', classes: 'row-table', },
]

const rows = [
  {
    name: 'Bárbada da Silva Silveira Fontes',
    bank: '756',
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },
  {
    name: 'Ice cream sandwich',
    bank: '237',
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },
  {
    name: 'Eclair',
    bank: '104',
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },
  {
    name: 'Cupcake',
    bank: '104',
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },
  {
    name: 'Gingerbread',
    bank: 356,
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: false,
  },
  {
    name: 'Jelly bean',
    bank: 375,
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },
  {
    name: 'Lollipop',
    bank: 392,
    document: '021.935.239-12',
    account: '01002713-9',
    agency: '0814-0',
    valid: true,
  },


]

const pagination = ref({
  sortBy: 'desc',
  descending: false,
  page: 1,
  rowsPerPage: 10
  // rowsNumber: xx if getting data from a server
})

export default defineComponent({
  name: 'list-favored',
  components: {
    ModalFavored
  },
  data(){
    return {
       openModalFavored: false,
       selected: ref([]),
       search: '',
       columns,
       rows,
       pagination,
    }
  },
  mounted() {

  },
  computed: {
    pagesNumber: function() {
      return Math.ceil(rows.length / pagination.value.rowsPerPage)
    },
    dataPaginate: function(){
      return this.$store.state.favored.dataPaginate
    }
  },
  methods: {
    handleClickRowTable(){
      this.openModalFavored = true
    },
    handlleClickAddFavored(){
      this.openModalFavored = true
    },
    searchFavored(){
      this.$store.dispatch('favored/search', { search: this.search })
    },
    getLogoBank(codBank){
      switch (codBank) {
        case '756': //SICOOB
            return require('../../assets/logo_bank/sicoob.png')
          break;
        case '237': //BRADESCO
            return require('../../assets/logo_bank/bradesco.png')
          break;
        case '104': //CAIXA
            return require('../../assets/logo_bank/caixa.png')
          break;

        default: //DEFAULT
            return require('../../assets/logo_bank/other_bank.png')
          break;
      }
    }
  },
  watch: {
    search(){
      this.searchFavored()
    }
  }
})
</script>
