<template>
  <q-page class="flex row">
    <div class="col-12 q-pl-xl q-pr-xl">
      <q-card class="flat bordered">
        <q-card-section class="bg-primary text-white">
          <div class="text-h6">Seus Favorecidos</div>
        </q-card-section>

        <q-separator />

        <q-card-section class="bg-blue-grey-1">
          <div class="row q-pa-lg">
              <div class="col-8">
                <div>
                  <span class="text-blue-grey-6 text-h5">Seus favorecidos </span>
                  <q-btn round color="primary" icon="add" />
                </div>
              </div>
              <div class="col-4">
                <q-input outlined
                        bg-color="white"
                        v-model="text" placeholder="Nome, CPF, Agência ou Conta"  :dense="true">
                      <template v-slot:append>
                    <q-btn round dense flat icon="search" />
                  </template>
                </q-input>
              </div>
          </div>
        </q-card-section>
      </q-card>

      <div class="col-12">
        <div class="q-pt-md">
          <q-table
            title="Favorecidos"
            :rows="rows"
            :columns="columns"
            row-key="name"
            selection="multiple"
            v-model:selected="selected"
          >
            <template v-slot:header-selection="scope">
              <q-toggle v-model="scope.selected" />
            </template>

            <template v-slot:body-selection="scope">
              <q-toggle v-model="scope.selected" />
            </template>
          </q-table>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { ref } from 'vue'

const columns = [
  {
    name: 'name',
    required: true,
    label: 'Nome',
    align: 'left',
    field: row => row.name,
    format: val => `${val}`,
    sortable: true
  },
  { name: 'document', align: 'center', label: 'CPF / CNPJ', field: 'document', sortable: true },
  { name: 'bank', label: 'Banco', field: 'bank', sortable: true },
  { name: 'agency', label: 'Agência', field: 'agency' },
  { name: 'account', label: 'CC', field: 'account' },
  { name: 'valid', label: 'Status do Favorecido', field: 'valid' },
]

const rows = [
  {
    name: 'Frozen Yogurt',
    bank: 159,
    document: 6.0,
    account: 24,
    agency: 4.0,
    sodium: 87,
  },
  {
    name: 'Ice cream sandwich',
    bank: 237,
    document: 9.0,
    account: 37,
    agency: 4.3,
    sodium: 129,
  },
  {
    name: 'Eclair',
    bank: 262,
    document: 16.0,
    account: 23,
    agency: 6.0,
    sodium: 337,
  },
  {
    name: 'Cupcake',
    bank: 305,
    document: 3.7,
    account: 67,
    agency: 4.3,
    sodium: 413,
  },
  {
    name: 'Gingerbread',
    bank: 356,
    document: 16.0,
    account: 49,
    agency: 3.9,
    sodium: 327,
  },
  {
    name: 'Jelly bean',
    bank: 375,
    document: 0.0,
    account: 94,
    agency: 0.0,
    sodium: 50,
  },
  {
    name: 'Lollipop',
    bank: 392,
    document: 0.2,
    account: 98,
    agency: 0,
    sodium: 38,
  },


]

export default defineComponent({
  name: 'PageIndex',
  data(){
    return {
       selected: ref([]),
       columns,
       rows
    }
  }
})
</script>
