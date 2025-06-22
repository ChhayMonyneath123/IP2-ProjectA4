<template>
  <div class="dashboard">
    <!-- Top Stats Row -->
    <div class="stats-grid">
      <div class="stat-card stat-orange">
        <div class="stat-content">
          <div class="stat-value">{{ totalOrders }}</div>
          <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-icon">📋</div>
      </div>

      <div class="stat-card stat-blue">
        <div class="stat-content">
          <div class="stat-value">{{ totalCustomers }}</div>
          <div class="stat-label">Total Customers</div>
        </div>
        <div class="stat-icon">👥</div>
      </div>

      <div class="stat-card stat-green">
        <div class="stat-content">
          <div class="stat-value">${{ totalRevenue }}</div>
          <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-icon">💰</div>
      </div>

      <div class="stat-card stat-purple">
        <div class="stat-content">
          <div class="stat-value">{{ totalMenue }}</div>
          <div class="stat-label">Total Menue</div>
        </div>
        <div class="stat-icon">📄</div>
      </div>
    </div>

    <!-- Loading Message -->
    <div v-if="loading" class="loading-message">
      <p>Loading dashboard data...</p>
    </div>

    <!-- Error Message -->
    <div v-if="error" class="error-message">
      <p>{{ error }}</p>
      <button @click="fetchData" class="retry-btn">Retry</button>
    </div>

    <!-- Second Row -->
    <div class="content-grid">
      <!-- Order Summary -->
      <div class="widget">
        <div class="widget-header">
          <h3>Order Summary</h3>
          <select class="filter-select">
            <option>Today</option>
            <option>Yesterday</option>
            <option>This Week</option>
          </select>
        </div>
        <div class="summary-content">
          <div class="summary-item">
            <div class="summary-label">Dine-In</div>
            <div class="summary-value">{{ dineInPercentage }}%</div>
          </div>
          <div class="summary-item">
            <div class="summary-label">Delivered</div>
            <div class="summary-value">{{ deliveredPercentage }}%</div>
          </div>
          <div class="summary-item">
            <div class="summary-label">Cancelled</div>
            <div class="summary-value">{{ cancelledPercentage }}%</div>
          </div>
        </div>
      </div>

      <!-- Top Food This Week -->
      <div class="widget">
        <div class="widget-header">
          <h3>Top order food this week</h3>
        </div>
        <div class="top-items">
          <div v-for="(item, index) in topFood" :key="index" class="item-row">
            <div class="item-dot" :style="{ backgroundColor: item.color }"></div>
            <span class="item-name">{{ item.name }}</span>
            <span class="item-value">{{ item.value }}%</span>
          </div>
        </div>
      </div>

      <!-- Top Drink This Week -->
      <div class="widget">
        <div class="widget-header">
          <h3>Top order drink this week</h3>
        </div>
        <div class="top-items">
          <div v-for="(item, index) in topDrinks" :key="index" class="item-row">
            <div class="item-dot" :style="{ backgroundColor: item.color }"></div>
            <span class="item-name">{{ item.name }}</span>
            <span class="item-value">{{ item.value }}%</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Row -->
    <div class="bottom-grid">
      <!-- Customer Map -->
      <div class="widget">
        <div class="widget-header">
          <h3>Customer Map</h3>
          <div class="chart-controls">
            <div class="legend-inline">
              <div class="legend-item-inline">
                <div class="legend-color-small purple"></div>
                <span>This week</span>
              </div>
              <div class="legend-item-inline">
                <div class="legend-color-small pink"></div>
                <span>Last week</span>
              </div>
            </div>
            <select class="filter-select">
              <option>Weekly ▲</option>
              <option>Monthly</option>
            </select>
          </div>
        </div>
        <div class="chart-placeholder">
          <p>Customer chart will be displayed here</p>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="widget">
        <div class="widget-header">
          <h3>Total Revenue</h3>
        </div>
        <div class="chart-placeholder">
          <p>Revenue chart will be displayed here</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'DashboardPage',
  data() {
    return {
      loading: false,
      error: null,
      totalOrders: 0,
      totalCustomers: 0,
      totalRevenue: 0,
      totalMenue: 0,
      dineInPercentage: 0,
      deliveredPercentage: 0,
      cancelledPercentage: 0,
      topFood: [],
      topDrinks: []
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true;
        this.error = null;
        
        // Fetch all dashboard data from backend
        const [
          statsResponse,
          orderSummaryResponse,
          topFoodResponse,
          topDrinksResponse
        ] = await Promise.all([
          axios.get('http://localhost:8000/api/dashboard/stats'),           
          axios.get('http://localhost:8000/api/dashboard/order-summary'),   
          axios.get('http://localhost:8000/api/dashboard/top-food'),        
          axios.get('http://localhost:8000/api/dashboard/top-drinks') ,
        ]);
        
        // Update stats data
        if (statsResponse.data) {
          this.totalOrders = statsResponse.data.totalOrders || 0;
          this.totalCustomers = statsResponse.data.totalCustomers || 0;
          this.totalRevenue = statsResponse.data.totalRevenue || 0;
          this.totalMenue = statsResponse.data.totalMenue || 0;
        }
        
        // Update order summary data
        if (orderSummaryResponse.data) {
          this.dineInPercentage = orderSummaryResponse.data.dineIn || 0;
          this.deliveredPercentage = orderSummaryResponse.data.delivered || 0;
          this.cancelledPercentage = orderSummaryResponse.data.cancelled || 0;
        }
        
        // Update top food data from backend
        if (topFoodResponse.data && Array.isArray(topFoodResponse.data)) {
          this.topFood = this.processTopItems(topFoodResponse.data);
        }
        
        // Update top drinks data from backend
        if (topDrinksResponse.data && Array.isArray(topDrinksResponse.data)) {
          this.topDrinks = this.processTopItems(topDrinksResponse.data);
        }
        
      } catch (error) {
        console.error('Error fetching dashboard data:', error);
        this.error = `Failed to load dashboard data: ${error.response?.status || error.message}`;
      } finally {
        this.loading = false;
      }
    },
    
    processTopItems(items) {
      const colors = ['#4A5568', '#48BB78', '#805AD5', '#4299E1', '#F56565', '#ED8936', '#38B2AC'];
      
      return items.map((item, index) => ({
        name: item.name || item.product_name || item.item_name,
        value: item.percentage || item.value || item.count || 0,
        color: item.color || colors[index % colors.length]
      }));
    }
  }
};
</script>

<style scoped>
.dashboard {
  padding: 20px;
  background-color: #f8f9fa;
  min-height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.stat-card {
  padding: 24px;
  border-radius: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.stat-orange { background-color: #fff7ed; }
.stat-blue { background-color: #eff6ff; }
.stat-green { background-color: #f0fdf4; }
.stat-purple { background-color: #faf5ff; }

.stat-value {
  font-size: 32px;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 4px;
}

.stat-label {
  color: #666;
  font-size: 14px;
  font-weight: 500;
}

.stat-icon {
  font-size: 24px;
  width: 48px;
  height: 48px;
  background-color: #6b7280;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.content-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.bottom-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 20px;
}

.widget {
  background: white;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.widget-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.widget-header h3 {
  font-size: 18px;
  font-weight: 600;
  color: #1a1a1a;
  margin: 0;
}

.filter-select {
  padding: 6px 12px;
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  font-size: 14px;
  background-color: white;
  cursor: pointer;
}

.summary-content {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.summary-item {
  text-align: center;
}

.summary-label {
  font-size: 14px;
  color: #666;
  margin-bottom: 8px;
}

.summary-value {
  font-size: 24px;
  font-weight: 600;
  color: #1a1a1a;
}

.top-items {
  space-y: 12px;
}

.item-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}

.item-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 12px;
}

.item-name {
  flex-grow: 1;
  font-size: 14px;
  color: #666;
}

.item-value {
  font-size: 14px;
  font-weight: 600;
  color: #1a1a1a;
}

.chart-controls {
  display: flex;
  align-items: center;
  gap: 16px;
}

.legend-inline {
  display: flex;
  gap: 16px;
}

.legend-item-inline {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  color: #666;
}

.legend-color-small {
  width: 12px;
  height: 12px;
  border-radius: 2px;
}

.purple { background-color: #8B5CF6; }
.pink { background-color: #EC4899; }

.chart-placeholder {
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f9f9f9;
  border-radius: 8px;
  color: #666;
}

.loading-message, .error-message {
  text-align: center;
  padding: 20px;
  margin: 20px 0;
}

.error-message {
  background-color: #fef2f2;
  border: 1px solid #fecaca;
  border-radius: 8px;
  color: #dc2626;
}

.retry-btn {
  background-color: #3b82f6;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 10px;
}

.retry-btn:hover {
  background-color: #2563eb;
}
</style>