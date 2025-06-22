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
        <div v-for="product in products" :key="product.id" class="product-row">
          <div class="product-info">
            <img :src="product.image" :alt="product.name" class="product-image" />
            <span class="product-name">{{ product.name }}</span>
          </div>

          <div class="product-category">
            <span class="category-tag" :class="getCategoryClass(product.category)">
              {{ product.category }}
            </span>
          </div>

          <div class="product-status">
            <span v-if="editingStatusId !== product.id" class="status-tag" :class="getStatusClass(product.status)">
              {{ product.status }}
            </span>

            <select v-else v-model="editedStatus" class="status-select" :class="getStatusClass(editedStatus)">
              <option value="In Stock">In Stock</option>
              <option value="Low Stock">Low Stock</option>
              <option value="Out of Stock">Out of Stock</option>
            </select>
          </div>

          <div class="product-actions">
            <!-- Show Update button when editing -->
            <button class="btn-update" v-if="editingStatusId === product.id" @click="updateProduct(product.id)">
              Update
            </button>

            <!-- Show Edit button when NOT editing -->
            <button class="btn-notification" v-else @click="editProduct(product.id)">
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
  name: "ProductManagement",
  data() {
    return {
      products: [], // fetched products list
      editingStatusId: null,
      editedStatus: "",
    };
  },
  methods: {
    getCategoryClass(category) {
      const classes = {
        Food: "category-food",
        Beverages: "category-beverages",
        Bakery: "category-bakery",
      };
      return classes[category] || "category-default";
    },

    getStatusClass(status) {
      const classes = {
        "In Stock": "status-in-stock",
        "Low Stock": "status-low-stock",
        "Out of Stock": "status-out-stock",
      };
      return classes[status] || "status-default";
    },

    editProduct(productId) {
      this.editingStatusId = productId;
      const product = this.products.find((p) => p.id === productId);
      this.editedStatus = product ? product.status : "";
    },

   async updateProduct(productId) {
  const product = this.products.find((p) => p.id === productId);
  if (!product) return;

  try {
    const response = await fetch(`http://localhost:8000/api/products/${productId}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ status: this.editedStatus }),
    });

    if (!response.ok) {
      const errorData = await response.json();
      console.error("Update failed:", errorData);
      throw new Error(errorData.message || "Failed to update product status");
    }

    const updatedProduct = await response.json();
    product.status = updatedProduct.status || this.editedStatus;
    this.editingStatusId = null;
    this.editedStatus = "";

    alert("Product status updated successfully.");
  } catch (error) {
    console.error("Error updating product:", error);
    alert("Could not update product status. Please try again.");
  }
}
,

    async fetchProducts() {
  try {
    const response = await fetch("http://localhost:8000/api/products");
    if (!response.ok) throw new Error("Failed to fetch products");
    const data = await response.json();
    console.log("Fetched products:", data);

    // Normalize data keys to match your template usage
    this.products = data.data.map(p => ({
      id: p.product_id,      // map product_id to id
      name: p.title,         // map title to name
      category: p.category ? p.category.name : "Uncategorized",  // assuming category relation returns {id, name}
      status: p.status || "In Stock",  // if you have a status field or default it
      image: p.image || "default-image.jpg",  // fallback if no image
      // add other properties if needed
    }));

  } catch (error) {
    console.error("Error fetching products:", error);
  }
}


  },
  mounted() {
    this.fetchProducts();
  },
};
</script>

<style scoped>
/* Your existing CSS styles remain the same */
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
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
