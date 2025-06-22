// resources/js/store/modules/wishlist.js
export default {
  namespaced: true,
  state: {
    items: []
  },
  mutations: {
    SET_WISHLIST(state, items) {
      state.items = items;
    },
    ADD_ITEM(state, product) {
      state.items.push(product);
    },
    REMOVE_ITEM(state, productId) {
      state.items = state.items.filter(item => item.id !== productId);
    }
  },
  actions: {
    async fetchWishlist({ commit }) {
      const response = await axios.get('/api/wishlist');
      commit('SET_WISHLIST', response.data);
    },
    async addToWishlist({ commit }, productId) {
      await axios.post(`/api/wishlist/${productId}`);
      commit('ADD_ITEM', { id: productId });
    },
    async removeFromWishlist({ commit }, productId) {
      await axios.delete(`/api/wishlist/${productId}`);
      commit('REMOVE_ITEM', productId);
    }
  },
  getters: {
    isInWishlist: (state) => (productId) => {
      return state.items.some(item => item.id === productId);
    }
  }
};