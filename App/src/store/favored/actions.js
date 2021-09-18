import { api } from 'boot/axios'

export function search (context, {search, perpage, page}) {
  api.get(`/api/favored?
  search=${search}
  &perpage=${perpage}
  &page=${page}`)
    .then((res) =>{
        context.commit('setDataPaginate', res.data || [])
    })

}

