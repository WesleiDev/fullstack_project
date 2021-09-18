<template>

  <div>
    <q-card class="flat bordered no-shadow">
        <q-card-section class="bg-primary text-white">
          <div class="text-h6 text-white">Seus Favorecidos</div>
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
                {{ formatDocument(props.row.document) }}
              </q-td>
              <q-td key="bank" :props="props">
                <img :src="getLogoBank(props.row.bank)" class="img-logo-bank-list"/>
              </q-td>
              <q-td key="agency" :props="props">
                {{ props.row.agency + '-' +props.row.agencyDigit }}
              </q-td>
              <q-td key="account" :props="props">
                {{ props.row.account + '-' +props.row.accountDigit }}
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
            v-model="currentPage"
            color="secondary"
            :max="pagesNumber"
            size="sm"
            :max-pages="6"
            boundary-numbers
            push
          />
        </div>
      </div>
    </div>
    <modal-favored :openModalFavored="openModalFavored"
                      @savedFavored="savedFavored($event)"
                      @closeModal="openModalFavored = $event"/>
  </div>
</template>

<script>
import { ref } from 'vue';
import ModalFavored from './ModalFavored';
import { formatDocument } from '../../utils'

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


const pagination = ref({
  sortBy: 'desc',
  descending: false,
  page: 1,
  rowsPerPage: 10
})

export default {
  name: 'list-favored',
  components: {
    ModalFavored
  },
  data(){
    return {
       formatDocument,
       openModalFavored: false,
       selected: ref([]),
       search: '',
       columns,
       rows : [],
       pagination,
       pagesNumber : 0,
       currentPage: 1
    }
  },
  mounted() {
    this.searchFavored()
  },
  computed: {
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
      this.$store.dispatch('favored/search', {
                                                search: this.search,
                                                perpage: this.pagination.rowsPerPage ,
                                                page: this.currentPage
                                              })
    },
    mountedDataTable(){
      const { data, links, meta } = this.dataPaginate
      this.currentPage = meta.current_page
      this.pagesNumber = meta.last_page
      this.rows = data
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
    },
    savedFavored(favored){
      this.openModalFavored = false
      this.searchFavored()
    }
  },
  watch: {
    search(){
      this.searchFavored()
    },
    dataPaginate(value){
      this.mountedDataTable()
    },
    currentPage(value){
      this.searchFavored()
    }

  }
}
</script>
