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
          <tr v-for="order in filteredOrders" :key="order.id">
            <td class="order-id">{{ order.orderId }}</td>
            <td class="customer-info">
              <div class="customer-container">
                <img :src="order.avatar" :alt="order.customerName" class="avatar">
                <span>{{ order.customerName }}</span>
              </div>
            </td>
            <td>{{ order.customerContact }}</td>
            <td>{{ order.delivery }}</td>
            <td>
              <span :class="['status', `status-${order.status.toLowerCase().replace('-', '')}`]">
                {{ order.status }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeliveryDetails',
  data() {
    return {
      searchQuery: '',
      selectedPeriod: 'Today',
      selectedYear: '2025',
      orders: [
        {
          id: 1,
          orderId: '#1002',
          customerName: 'Sarah Johnson',
          customerContact: '071 326 8479',
          delivery: '012 665 989',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 2,
          orderId: '#1003',
          customerName: 'Michael Chen',
          customerContact: '081 456 7890',
          delivery: '022 334 556',
          status: 'Pick-Up',
          avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 3,
          orderId: '#1004',
          customerName: 'Emma Rodriguez',
          customerContact: '065 789 1234',
          delivery: '033 778 990',
          status: 'Arrived',
          avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 4,
          orderId: '#1005',
          customerName: 'David Kim',
          customerContact: '078 234 5678',
          delivery: '044 112 334',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 5,
          orderId: '#1006',
          customerName: 'Lisa Thompson',
          customerContact: '082 567 8901',
          delivery: '055 667 889',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 6,
          orderId: '#1007',
          customerName: 'Ahmed Hassan',
          customerContact: '073 345 6789',
          delivery: '066 445 667',
          status: 'Pick-Up',
          avatar: 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 7,
          orderId: '#1008',
          customerName: 'Rachel Green',
          customerContact: '089 678 9012',
          delivery: '077 223 445',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1489424731084-a5d8b219a5bb?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 8,
          orderId: '#1009',
          customerName: 'Carlos Martinez',
          customerContact: '074 456 7890',
          delivery: '088 556 778',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 9,
          orderId: '#1010',
          customerName: 'Anna Kowalski',
          customerContact: '085 789 0123',
          delivery: '099 334 556',
          status: 'Pick-Up',
          avatar: 'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 10,
          orderId: '#1011',
          customerName: 'James Wilson',
          customerContact: '076 567 8901',
          delivery: '010 778 990',
          status: 'Arrived',
          avatar: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 11,
          orderId: '#1012',
          customerName: 'Priya Patel',
          customerContact: '087 678 9012',
          delivery: '021 112 334',
          status: 'Arrived',
          avatar: 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 12,
          orderId: '#1013',
          customerName: 'Robert Lee',
          customerContact: '079 789 0123',
          delivery: '032 445 667',
          status: 'Accept',
          avatar: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 13,
          orderId: '#1014',
          customerName: 'Sofia Andersson',
          customerContact: '083 890 1234',
          delivery: '043 667 889',
          status: 'Pick-Up',
          avatar: 'https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?w=40&h=40&fit=crop&crop=face&auto=format'
        },
        {
          id: 14,
          orderId: '#1015',
          customerName: 'Kevin O\'Connor',
          customerContact: '080 901 2345',
          delivery: '054 223 445',
          status: 'Pick-Up',
          avatar: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=40&h=40&fit=crop&crop=face&auto=format'
        }
      ]
    }
  },
  computed: {
    filteredOrders() {
      if (!this.searchQuery) {
        return this.orders;
      }
      
      return this.orders.filter(order => 
        order.orderId.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        order.customerName.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        order.customerContact.includes(this.searchQuery) ||
        order.delivery.includes(this.searchQuery) ||
        order.status.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  }
}
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

@media (max-width: 768px) {
  .header {
    flex-direction: column;
    align-items: stretch;
    gap: 16px;
  }
  
  .controls {
    justify-content: space-between;
  }
  
  .search-input {
    width: 150px;
  }
  
  .delivery-table {
    font-size: 12px;
  }
  
  .delivery-table th,
  .delivery-table td {
    padding: 12px 8px;
  }
  
  .customer-container {
    gap: 8px;
  }
  
  .avatar {
    width: 28px;
    height: 28px;
  }
}
</style>