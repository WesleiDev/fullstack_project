import { api } from 'boot/axios'

export function search (context, {search, perpage, page}) {

  api.get(`/api/favored?
  search=${search}
  &perpage=${perpage}
  &page=${page}`)
    .then((res) =>{
        console.log('RES FAVORED: ', res.data)
        context.commit('setDataPaginate', res.data || [])
    })

}
