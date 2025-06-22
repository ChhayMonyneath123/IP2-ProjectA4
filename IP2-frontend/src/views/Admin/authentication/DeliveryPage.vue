<template>
  <div class="delivery-details">
    <!-- Header -->
    <div class="header">
      <h2 class="title">Delivery Details</h2>
      
      <div class="controls">
        <!-- Search Input -->
        <div class="search-container">
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Search..."
            class="search-input"
          />
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
        </div>
        
        <!-- Filter Dropdowns -->
        <select v-model="selectedPeriod" class="filter-select">
          <option value="Today">Today</option>
          <option value="Yesterday">Yesterday</option>
          <option value="This Week">This Week</option>
          <option value="This Month">This Month</option>
        </select>
        
        <select v-model="selectedYear" class="filter-select">
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
        </select>
      </div>
    </div>

    <!-- Table -->
    <div class="table-container">
      <table class="delivery-table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Customer Contact</th>
            <th>Delivery</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in filteredOrders" :key="order.delivery_id">
            <td class="order-id">#{{ order.delivery_id }}</td>
            <td class="customer-info">
              <div class="customer-container">
                <img :src="order.avatar" :alt="order.customer_name" class="avatar">
                <span>{{ order.customer_name }}</span>
              </div>
            </td>
            <td>{{ order.customer_contact }}</td>
            <td>{{ order.delivery_contact }}</td>
            <td>
              <select
                v-model="order.delivery_status"
                @change="updateStatus(order.delivery_id, order.delivery_status)"
                :class="['status', `status-${order.delivery_status.toLowerCase().replace('-', '')}`]"
              >
                <option value="ACCEPT">Accept</option>
                <option value="PICK-UP">Pick-Up</option>
                <option value="ARRIVED">Arrived</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'DeliveryPage',
  data() {
    return {
      searchQuery: '',
      selectedPeriod: 'Today',
      selectedYear: '2025',
      deliveries: [
        {
          delivery_id: 1002,
          customer_name: 'Sokha Kim',
          customer_contact: '012 345 678',
          delivery_contact: '095 888 777',
          delivery_status: 'PICK-UP',
          avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face&auto=format'
        },
        {
          delivery_id: 1003,
          customer_name: 'Jochido Nitacha',
          customer_contact: '071 326 8479',
          delivery_contact: '012 665 989',
          delivery_status: 'ACCEPT',
          avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b412?w=32&h=32&fit=crop&crop=face&auto=format'
        },
        {
          delivery_id: 1004,
          customer_name: 'Sarah Johnson',
          customer_contact: '085 123 456',
          delivery_contact: '097 555 333',
          delivery_status: 'ARRIVED',
          avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=32&h=32&fit=crop&crop=face&auto=format'
        }
      ]
    };
  },
  computed: {
    filteredOrders() {
      if (!this.searchQuery) {
        return this.deliveries;
      }
      
      return this.deliveries.filter(order => 
        order.delivery_id.toString().includes(this.searchQuery) ||
        order.customer_name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        order.customer_contact.includes(this.searchQuery) ||
        order.delivery_contact.includes(this.searchQuery) ||
        order.delivery_status.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  // mounted() {
  //   axios
  //     .get('/api/admin/deliveries')
  //     .then((res) => {
  //       this.deliveries = res.data;
  //     })
  //     .catch((err) => {
  //       console.error('Failed to fetch deliveries:', err);
  //     });
  // },
  methods: {
    updateStatus(id, newStatus) {
      axios
        .patch(`/api/admin/deliveries/${id}/status`, { status: newStatus })
        .then(() => {
          console.log(`Status updated for delivery ID ${id} to ${newStatus}`);
        })
        .catch((err) => {
          console.error(`Failed to update status for ID ${id}:`, err.response?.data || err);
        });
    }
  }
};
</script>

<style scoped>
.delivery-details {
  padding: 20px;
  background-color: #f8f9fa;
  min-height: calc(100vh - 60px);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  width: 100%;
}

.title {
  font-size: 28px;
  font-weight: 700;
  color: #1a1a1a;
  margin: 0;
  text-align: left;
  font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
  letter-spacing: -0.5px;
  text-transform: none;
}

.controls {
  display: flex;
  align-items: center;
  gap: 16px;
}

.search-container {
  position: relative;
}

.search-input {
  padding: 8px 12px 8px 36px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  font-size: 14px;
  width: 200px;
  background-color: white;
}

.search-input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  pointer-events: none;
}

.filter-select {
  padding: 8px 12px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  font-size: 14px;
  background-color: white;
  cursor: pointer;
}

.filter-select:focus {
  outline: none;
  border-color: #007bff;
}

.table-container {
  background-color: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.delivery-table {
  width: 100%;
  border-collapse: collapse;
}

.delivery-table th {
  background-color: #f8f9fa;
  padding: 16px;
  text-align: left;
  font-weight: 600;
  color: #666;
  font-size: 14px;
  border-bottom: 1px solid #e0e0e0;
}

.delivery-table td {
  padding: 16px;
  border-bottom: 1px solid #f0f0f0;
  font-size: 14px;
  color: #333;
}

.delivery-table tr:hover {
  background-color: #f8f9fa;
}

.order-id {
  font-weight: 600;
  color: #333;
}

.customer-container {
  display: flex;
  align-items: center;
  gap: 12px;
}

.avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  object-fit: cover;
}

.status {
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  text-transform: uppercase;
  border: none;
  cursor: pointer;
  appearance: none;
  background-color: transparent;
}

.status-accept {
  background-color: #e3f2fd;
  color: #1976d2;
}

.status-pickup {
  background-color: #fff3e0;
  color: #f57c00;
}

.status-arrived {
  background-color: #e8f5e8;
  color: #2e7d32;
}

.status:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
}
</style>