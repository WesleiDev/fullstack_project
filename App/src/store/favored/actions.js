import axios from 'axios';

export function search (context, search) {
  console.log('VUE: ', axios)
  axios
    .get(`/api/favored?
    search=${search}`)
    .then((res) =>{
        context.commit('setDataPaginate', res.data || [])
    })

}
