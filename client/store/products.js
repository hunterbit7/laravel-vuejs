const state = () => ({
  dataListCustomers: [],
  page: '',
})

const getters = {}

const mutations = {
  SET_DATA(state, getData) {
    state.dataListCustomers = getData
    state.total = getData.total
  },
  DESTROY_DATA(state) {
    state.dataListCustomers = []
  },
}

const actions = {
  async loadData({ commit }, state) {
    commit('DESTROY_DATA')
    await this.$axios
      .get(`/products/${state.id}/?page=${state.page}`, {
        headers: {
          Authorization: `Bearer ${this.$auth.strategy.token.get()}`,
          'Content-Type': 'application/json',
        },
      })
      .then((r) => r.data.data)
      .then((getData) => {
        commit('SET_DATA', getData)
      })
  },
}

export default {
  state,
  getters,
  mutations,
  actions,
}
