<template>
    <div class="review-card">
      <div class="review-header">
        <div class="reviewer-info">
          <img :src="review.avatar" alt="Reviewer Avatar" class="reviewer-avatar" />
          <div class="details">
            <span class="reviewer-name">{{ review.reviewerName }}</span>
            <span class="reviewer-title">{{ review.reviewerTitle }}</span>
            <span class="followers">{{ review.followers }} following</span>
          </div>
        </div>
        <div class="review-meta">
          <div class="stars">
            <template v-for="n in 5" :key="n">
              <span :class="{ 'star-filled': n <= review.rating, 'star-empty': n > review.rating }">&#9733;</span>
            </template>
          </div>
          <span class="review-date">{{ review.date }}</span>
          <div class="options-menu">...</div>
        </div>
      </div>
      <div class="review-body">
        <p>{{ review.text }}</p>
      </div>
      <div class="review-actions">
        <button class="action-button public-comment">Public Comment</button>
        <button class="action-button edit-message">Edit message</button>
        <button class="action-button reply">Reply</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Review_Card', // Component name matching the file structure
    props: {
      review: {
        type: Object,
        required: true,
        validator: (value) => {
          // Basic validation to ensure expected properties exist
          return ['reviewerName', 'reviewerTitle', 'followers', 'avatar', 'rating', 'date', 'text'].every(
            (prop) => Object.prototype.hasOwnProperty.call(value, prop)
          );
        },
      },
    },
  };
  </script>
  
  <style scoped>
  .review-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 20px;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif; /* Consistent font */
    color: #333;
  }
  
  .review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Align avatar and text to the top */
    margin-bottom: 15px;
  }
  
  .reviewer-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
  }
  
  .reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0; /* Prevent avatar from shrinking */
  }
  
  .details {
    display: flex;
    flex-direction: column;
    text-align: left;
  }
  
  .reviewer-name {
    font-weight: bold;
    color: #2c3e50; /* Darker blue/grey */
    font-size: 1.1em;
  }
  
  .reviewer-title,
  .followers {
    font-size: 0.85em;
    color: #7f8c8d; /* Grey text */
  }
  
  .review-meta {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  
  .stars {
    color: #f39c12; /* Star rating color (orange/yellow) */
    font-size: 1.3em;
  }
  
  .star-empty {
    color: #ccc; /* Color for un-filled stars */
  }
  
  .review-date {
    font-size: 0.85em;
    color: #7f8c8d;
  }
  
  .options-menu {
    font-size: 1.5em;
    font-weight: bold;
    color: #999;
    cursor: pointer;
    padding: 0 5px; /* Add some padding for easier clicking */
  }
  
  .review-body p {
    font-size: 0.95em;
    line-height: 1.6;
    color: #555;
    margin-bottom: 20px;
    text-align: left;
  }
  
  .review-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end; /* Align buttons to the right */
  }
  
  .action-button {
    padding: 8px 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f4f4f4;
    color: #555;
    font-size: 0.9em;
    cursor: pointer;
    transition: background-color 0.2s, border-color 0.2s;
  }
  
  .action-button:hover {
    background-color: #e0e0e0;
    border-color: #bbb;
  }
  
  .action-button.reply {
    background-color: #A08C79; /* Button color from your previous designs */
    color: white;
    border-color: #A08C79;
  }
  
  .action-button.reply:hover {
    background-color: #8D7A65;
    border-color: #8D7A65;
  }
  </style>