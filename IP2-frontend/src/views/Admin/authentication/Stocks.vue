<template>
  <div class="product-management">
    <div class="header">
      <h1>All Products</h1>
    </div>
    
    <div class="table-container">
      <div class="table-header">
        <div class="col-name">Name</div>
        <div class="col-categories">Categories</div>
        <div class="col-status">Status</div>
        <div class="col-manage">Manage</div>
      </div>
      
      <div class="product-list">
        <div 
          v-for="product in products" 
          :key="product.id"
          class="product-row"
        >
          <div class="product-info">
            <img :src="product.image" :alt="product.name" class="product-image">
            <span class="product-name">{{ product.name }}</span>
          </div>
          
          <div class="product-category">
            <span 
              class="category-tag" 
              :class="getCategoryClass(product.category)"
            >
              {{ product.category }}
            </span>
          </div>
          
          <div class="product-status">
            <span
              v-if="editingStatusId !== product.id"
              class="status-tag"
              :class="getStatusClass(product.status)"
            >
                {{ product.status }}
            </span>

            <select 
              v-else
              v-model="editedStatus"
              class="status-select"
              :class="getStatusClass(editedStatusstatus)"
            >
              <option value="In Stock">In Stock</option>
              <option value="Low Stock">Low Stock</option>
              <option value="Out of Stock">Out of Stock</option>
            </select>
          </div>
          
          <div class="product-actions">
            <!-- Show Update button when editing -->
            <button 
              class="btn-update" 
              v-if="editingStatusId === product.id"
              @click="updateProduct(product.id)"
            >
              Update
            </button>

            <!-- Show Edit button when NOT editing -->
            <button 
              class="btn-notification"
              v-else
              @click="editProduct(product.id)"
            >
              Edit
            </button>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductManagement',
  data() {
    return {
      products: [
        {
          id: 1,
          name: 'Amok Trey with cheese',
          category: 'Food',
          status: 'In Stock',
          image: 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 2,
          name: 'Strawberry Soda',
          category: 'Beverages',
          status: 'In Stock',
          image: 'https://images.unsplash.com/photo-1622597467836-f3285f2131b8?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 3,
          name: 'Margherita Pizza',
          category: 'Food',
          status: 'Low Stock',
          image: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 4,
          name: 'Caesar Salad Bowl',
          category: 'Food',
          status: 'In Stock',
          image: 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 5,
          name: 'Fresh Orange Juice',
          category: 'Beverages',
          status: 'Out of Stock',
          image: 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 6,
          name: 'Chocolate Croissant',
          category: 'Bakery',
          status: 'In Stock',
          image: 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 7,
          name: 'Grilled Salmon',
          category: 'Food',
          status: 'In Stock',
          image: 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=100&h=100&fit=crop&crop=center'
        },
        {
          id: 8,
          name: 'Iced Coffee Latte',
          category: 'Beverages',
          status: 'Low Stock',
          image: 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=100&h=100&fit=crop&crop=center'
        }
      ],
      editingStatusId: null,
      editedStatus: ''
    }
  },
  methods: {
    getCategoryClass(category) {
      const classes = {
        'Food': 'category-food',
        'Beverages': 'category-beverages',
        'Bakery': 'category-bakery'
      }
      return classes[category] || 'category-default'
    },

    getStatusClass(status) {
      const classes = {
        'In Stock': 'status-in-stock',
        'Low Stock': 'status-low-stock',
        'Out of Stock': 'status-out-stock'
      };
      return classes[status] || 'status-default';
    },

    editProduct(productId) {
      this.editingStatusId = productId;
      const product = this.products.find(p => p.id === productId);
      this.editedStatus = product.status; 
    },

    updateProduct(productId) {
      const product = this.products.find(p => p.id === productId);
      if (product) {
        product.status = this.editedStatus;
        this.editingStatusId = null;
        this.editedStatus = '';
      }
    }
  }
}
</script>

<style scoped>
.product-management {
  padding: 20px;
  background-color: #f5f5f5;
  min-height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.header h1 {
  color: #666;
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 20px;
}

.table-container {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table-header {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1.5fr;
  padding: 16px 20px;
  background-color: #fafafa;
  border-bottom: 1px solid #e0e0e0;
  font-weight: 600;
  color: #666;
  font-size: 14px;
}

.product-row {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1.5fr;
  padding: 16px 20px;
  border-bottom: 1px solid #e0e0e0;
  align-items: center;
  transition: background-color 0.2s;
}

.product-row:hover {
  background-color: #f9f9f9;
}

.product-row:last-child {
  border-bottom: none;
}

.product-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.product-image {
  width: 48px;
  height: 48px;
  border-radius: 8px;
  object-fit: cover;
  background-color: #f0f0f0;
}

.product-name {
  font-size: 15px;
  font-weight: 500;
  color: #333;
}

.category-tag {
  padding: 4px 12px;
  border-radius: 16px;
  font-size: 12px;
  font-weight: 500;
  display: inline-block;
}

.category-food {
  background-color: #fff3e0;
  color: #f57c00;
}

.category-beverages {
  background-color: #e3f2fd;
  color: #1976d2;
}

.category-bakery {
  background-color: #fce4ec;
  color: #c2185b;
}

.status-tag,
.status-select {
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: 500;
  min-width: 100px;
  text-align: center;
}

.status-in-stock {
  background-color: #e6f4ea;
  color: #2e7d32;
  border: 1px solid #a5d6a7;
}

.status-low-stock {
  background-color: #fff3e0;
  color: #ef6c00;
  border: 1px solid #ffb74d;
}

.status-out-stock {
  background-color: #fdecea;
  color: #d32f2f;
  border: 1px solid #e57373;
}

/* === CATEGORY TAGS === */
.category-food {
  background-color: #fff3cd;
  color: #856404;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 0.8rem;
}

.category-beverages {
  background-color: #d0ebff;
  color: #0b5394;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 0.8rem;
}

.category-bakery {
  background-color: #fce4ec;
  color: #ad1457;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 0.8rem;
}

/* === BUTTON STYLES === */
.btn-update {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 6px 12px;
  margin-right: 6px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-update:hover {
  background-color: #388e3c;
}

.btn-notification {
  background-color: #9e9e9e;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-notification:hover {
  background-color: #757575;
}

/* === SELECT STYLE === */
.status-select {
  border: 1px solid #ccc;
  font-weight: 500;
}

@media (max-width: 768px) {
  .table-header,
  .product-row {
    grid-template-columns: 1fr;
    gap: 8px;
  }
  
  .product-actions {
    justify-content: flex-start;
  }
}
</style>