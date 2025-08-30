import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
    total: 0
  }),

  getters: {
    itemCount: (state) => state.items.length,
    cartTotal: (state) => {
      return state.items.reduce((total, item) => {
        return total + (parseFloat(item.price) * item.quantity);
      }, 0);
    },
    formattedTotal: (state) => {
  return `৳${state.cartTotal.toFixed(2)}`;
    }
  },

  actions: {
    addItem(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({ ...item, quantity: 1 });
      }
      
      this.total = this.items.reduce((total, item) => {
        return total + (parseFloat(item.price) * item.quantity);
      }, 0);
    },

    removeItem(itemId) {
      this.items = this.items.filter(item => item.id !== itemId);
      this.total = this.items.reduce((total, item) => {
        return total + (parseFloat(item.price) * item.quantity);
      }, 0);
    },

    updateQuantity(itemId, quantity) {
      const item = this.items.find(i => i.id === itemId);
      if (item) {
        item.quantity = quantity;
        if (item.quantity <= 0) {
          this.removeItem(itemId);
        } else {
          this.total = this.items.reduce((total, item) => {
            return total + (parseFloat(item.price) * item.quantity);
          }, 0);
        }
      }
    },

    clearCart() {
      this.items = [];
      this.total = 0;
    }
  }
});
