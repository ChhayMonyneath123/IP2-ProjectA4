<template>
    <div class="dashboard-page-content">
      <h2>Dashboard Overview</h2>
  
      <div class="dashboard-stats">
        <div class="stat-card">
          <h3>Total Orders</h3>
          <p class="stat-value">1,250</p>
          <span class="stat-trend">+10% from last month</span>
        </div>
        <div class="stat-card">
          <i class="fa-regular fa-face-smile"></i>
          <h3>Revenue</h3>
          <p class="stat-value">$25,000</p>
          <span class="stat-trend">+15% from last month</span>
        </div>
        <div class="stat-card">
          <h3>New Users</h3>
          <p class="stat-value">150</p>
          <span class="stat-trend">+5% from last month</span>
        </div>
        <div class="stat-card">
          <h3>Pending Reviews</h3>
          <p class="stat-value">25</p>
          <span class="stat-trend">-20% from last week</span>
        </div>
      </div>
  
      <div class="dashboard-charts">
        <div class="chart-container">
          <h3>Sales Performance</h3>
          <div class="chart-placeholder">Graph/Chart will go here</div>
        </div>
        <div class="chart-container">
          <h3>Popular Products</h3>
          <ul class="product-list">
            <li>Product A (120 units)</li>
            <li>Product B (95 units)</li>
            <li>Product C (80 units)</li>
            <li>Product D (60 units)</li>
          </ul>
        </div>
      </div>
  
      <div class="recent-activities">
        <h3>Recent Activities</h3>
        <ul class="activity-list">
          <li>New order #1234 placed by John Doe.</li>
          <li>Review added by Alex Jurk for Dish Name.</li>
          <li>Stock for Product X is low.</li>
          <li>Delivery for order #1230 completed.</li>
          <li>New user registered: Jane Smith.</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Dashboard',
    data() {
      return {
        totalOrders: 1250,
        revenue: 25000,
        newUsers: 150,
        pendingReviews: 25,
      };
    },
    mounted() {
      // Fetch data here
    },
    methods: {
      // Methods for fetching data
    },
  };
  </script>
  
  <style scoped>
  .dashboard-page-content {
    padding: 2%;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    margin: 1%;
    font-family: 'Arial', sans-serif;
    color: #333;
  }
  
  h2 {
    font-size: 1.8em;
    color: #2c3e50;
    margin-bottom: 15px;
    text-align: left;
  }
  
  h3 {
    font-size: 1.3em;
    color: #34495e;
    margin-bottom: 15px;
    text-align: left;
  }
  
  .dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
  }
  
  .stat-card {
    background-color: #f4f4f4;
    border-radius: 8px;
    padding: 20px;
    text-align: left;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
  }
  
  .stat-value {
    font-size: 2em;
    font-weight: bold;
    color: #A08C79;
    margin: 10px 0;
  }
  
  .stat-trend {
    font-size: 0.9em;
    color: #27ae60;
  }
  
  .dashboard-charts {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
  }
  
  .chart-container {
    background-color: #f4f4f4;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
  }
  
  .chart-placeholder {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #e9e9e9;
    border-radius: 5px;
    min-height: 200px;
    color: #777;
    font-style: italic;
  }
  
  .product-list {
    list-style: none;
    padding: 0;
    margin-top: 10px;
  }
  
  .product-list li {
    padding: 8px 0;
    border-bottom: 1px dashed #eee;
    font-size: 0.95em;
    color: #555;
  }
  
  .product-list li:last-child {
    border-bottom: none;
  }
  
  .recent-activities {
    background-color: #f4f4f4;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
  }
  
  .activity-list {
    list-style: none;
    padding: 0;
    margin-top: 10px;
  }
  
  .activity-list li {
    padding: 8px 0;
    border-bottom: 1px dashed #eee;
    font-size: 0.95em;
    color: #555;
  }
  
  .activity-list li:last-child {
    border-bottom: none;
  }
  </style>