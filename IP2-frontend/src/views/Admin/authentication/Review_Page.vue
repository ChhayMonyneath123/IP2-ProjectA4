<template>
    <div class="reviews-page-layout">
      
  
      <main class="main-content">
  
        <div class="reviews-section">
          <div class="reviews-header-bar">
            <div class="sort-by">
              <span>Sort By:</span>
              <select v-model="sortBy">
                <option value="time">Time</option>
                <option value="rating-high">Rating (High to Low)</option>
                <option value="rating-low">Rating (Low to High)</option>
              </select>
              <span class="dropdown-arrow">&#9662;</span>
            </div>
          </div>
  
          <div class="review-list">
            <Review_card v-for="review in sortedReviews" :key="review.id" :review="review" />
          </div>
        </div>
      </main>
    </div>
  </template>
  
  <script>
  // Corrected import path based on the file structure provided:
  // from `src/views/Admin/authentication/` to `src/components/admin_component/`
  import Review_card from '@/components/Admin_Component/review_card.vue';
  import jennyAvatar from "@/assets/images/profile.jpg";
  export default {
    name: 'Review_Page', // Component name matching the file structure
    components: {
      Review_card, // Register the imported component
    },
    data() {
      return {
        sortBy: 'time', // Default sort option
        reviews: [
          {
            id: 1,
            reviewerName: 'Alex Jurk',
            reviewerTitle: 'Student in ITC',
            followers: 50,
            avatar:jennyAvatar, // Placeholder, replace with actual image path
            rating: 4,
            date: '01/03/2023',
            text: 'Amazing food and great service! I ordered the Dish Name, and it was absolutely delicious. The flavors were perfect balanced, and the presentation was beautiful. However, I felt the dessert was a bit too sweet for my taste. Overall, a solid 4-star experience and would highly recommend this place for anyone looking for high-quality food and a nice atmosphere.',
          },
          {
            id: 2,
            reviewerName: 'Alex Jurk',
            reviewerTitle: 'Student in ITC',
            followers: 50,
            avatar: jennyAvatar,
            rating: 5,
            date: '03/05/2023',
            text: 'Best meal I\'ve had in a long time! The crispy fish was cooked to perfection, and the staff were attentive and beyond to make sure I was happy with my order. I also loved how they offer so many healthy options. The atmosphere was perfect for a casual dinner. Can\'t wait to come back!',
          },
          {
            id: 3,
            reviewerName: 'Alex Jurk',
            reviewerTitle: 'Student in ITC',
            followers: 50,
            avatar: jennyAvatar,
            rating: 3,
            date: '04/11/2023',
            text: 'The food was really good! I ordered the Green Tea, and while it tasted great, I felt the portion could have been a little bigger for the price. Still, the flavors were spot on, and the service was fast! Will definitely be coming back to try other dishes!',
          },
          {
            id: 4,
            reviewerName: 'Alex Jurk',
            reviewerTitle: 'Student in ITC',
            followers: 50,
            avatar: jennyAvatar,
            rating: 4,
            date: '04/11/2023',
            text: 'The food was really good! I ordered the Green Tea, and while it tasted great, I felt the portion could have been a little bigger for the price. Still, the flavors were spot on, and the service was fast! Will definitely be coming back to try other dishes!',
          },
          {
            id: 5,
            reviewerName: 'Alex Jurk',
            reviewerTitle: 'Student in ITC',
            followers: 50,
            avatar: jennyAvatar,
            rating: 3,
            date: '14/01/2023',
            text: 'The food was really good! I ordered the Green Tea, and while it tasted great, I felt the portion could have been a little bigger for the price. Still, the flavors were spot on, and the service was fast! Will definitely be coming back to try other dishes!',
          },
          // Add more review objects as needed
        ],
      };
    },
    computed: {
      sortedReviews() {
        // Create a shallow copy to avoid mutating the original array
        let sorted = [...this.reviews];
  
        if (this.sortBy === 'time') {
          // Assuming date is in 'DD/MM/YYYY' format for sorting,
          // convert to 'YYYY-MM-DD' for accurate chronological sort (newest first)
          sorted.sort((a, b) => {
            const [dayA, monthA, yearA] = a.date.split('/').map(Number);
            const [dayB, monthB, yearB] = b.date.split('/').map(Number);
            const dateA = new Date(yearA, monthA - 1, dayA); // Month is 0-indexed
            const dateB = new Date(yearB, monthB - 1, dayB);
            return dateB.getTime() - dateA.getTime();
          });
        } else if (this.sortBy === 'rating-high') {
          sorted.sort((a, b) => b.rating - a.rating); // Higher rating first
        } else if (this.sortBy === 'rating-low') {
          sorted.sort((a, b) => a.rating - b.rating); // Lower rating first
        }
        return sorted;
      },
    },
    // In a real application, you would fetch reviews from an API here
    // mounted() {
    //   this.fetchReviews();
    // },
    // methods: {
    //   async fetchReviews() {
    //     try {
    //       const response = await fetch('/api/reviews'); // Replace with your actual API endpoint
    //       const data = await response.json();
    //       this.reviews = data;
    //     } catch (error) {
    //       console.error('Error fetching reviews:', error);
    //       // Handle error (e.g., show error message to user)
    //     }
    //   }
    // }
  };
  </script>
  
  <style scoped>
  /*
    The styles below are designed to create the layout shown in your screenshot.
    They are 'scoped' to this component, meaning they won't affect other parts of your app.
  */
  .reviews-page-layout {
    display: flex;
    min-height: 100vh; /* Ensures the layout takes at least the full viewport height */
    background-color: #f8f8f8; /* Light background for the whole page */
    font-family: 'Arial', sans-serif; /* Consistent font */
  }
  
  /* --- Sidebar Styling --- */
  .sidebar {
    width: 250px; /* Fixed width as per image */
    background-color: #ffffff;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05); /* Subtle shadow on the right */
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    flex-shrink: 0; /* Prevent sidebar from shrinking when content grows */
  }
  
  .sidebar-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 20px 30px; /* Padding for header content */
    border-bottom: 1px solid #eee; /* Separator line below header */
    margin-bottom: 20px; /* Space after the header */
  }
  
  .sidebar-logo-icon {
    width: 40px;
    height: 40px;
    object-fit: contain; /* Ensures logo fits without distortion */
  }
  
  .sidebar-logo-text {
    font-size: 1.4em;
    font-weight: bold;
    color: #2c3e50; /* Dark text color for logo */
  }
  
  .sidebar-nav ul {
    list-style: none; /* Remove bullet points */
    padding: 0;
    margin: 0;
  }
  
  .nav-item {
    display: flex;
    align-items: center;
    gap: 15px; /* Space between icon and text */
    padding: 12px 20px;
    text-decoration: none; /* Remove underline from links */
    color: #555; /* Default text color for nav items */
    font-size: 1em;
    transition: background-color 0.2s, color 0.2s; /* Smooth transitions for hover/active states */
    border-left: 5px solid transparent; /* Space for the active indicator bar */
  }
  
  .nav-item:hover {
    background-color: #f0f0f0; /* Light background on hover */
  }
  
  .nav-item.active {
    background-color: #e0e0e0; /* Active background color */
    color: #A08C79; /* Active text color, matching your button/accent color */
    font-weight: bold;
    border-left-color: #A08C79; /* Active indicator bar color */
  }
  
  .nav-item .icon {
    width: 20px; /* Placeholder for icons */
    height: 20px;
    background-color: #ccc; /* Placeholder icon color */
    border-radius: 3px;
    /* In a real app, you would replace this with actual SVG icons, Font Awesome, etc. */
  }
  
  .nav-item.active .icon {
    background-color: #A08C79; /* Active icon color */
  }
  
  .sidebar-version {
    margin-top: auto; /* Pushes the version number to the bottom */
    padding: 20px;
    font-size: 0.8em;
    color: #bbb; /* Lighter text color for version */
    text-align: center;
  }
  
  /* --- Main Content Styling --- */
  .main-content {
    flex-grow: 1; /* Allows main content to take up remaining horizontal space */
    display: flex;
    flex-direction: column;
    padding: 0 30px; /* Horizontal padding for the content area */
  }
  
  .top-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #eee; /* Separator below the header */
    margin-bottom: 30px; /* Space after the header */
  }
  
  .header-left {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  
  .header-icon-text {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.6em;
    font-weight: bold;
    color: #333;
  }
  
  .header-main-icon {
    width: 30px; /* Icon size */
    height: 30px;
    object-fit: contain;
  }
  
  .header-right {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  
  .header-icon-wrapper {
    width: 35px; /* Size for clickable icon areas */
    height: 35px;
    border-radius: 50%; /* Makes it circular */
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0; /* Light background for icons */
    cursor: pointer;
    transition: background-color 0.2s;
  }
  
  .header-icon-wrapper:hover {
    background-color: #e6e6e6; /* Slightly darker background on hover */
  }
  
  .header-icon-wrapper img {
    width: 60%; /* Size of the actual icon inside the wrapper */
    height: 60%;
    object-fit: contain;
  }
  
  .reviews-section {
    flex-grow: 1; /* Allows the review list to take up remaining vertical space */
  }
  
  .reviews-header-bar {
    display: flex;
    justify-content: flex-end; /* Aligns the sort control to the right */
    align-items: center;
    margin-bottom: 25px;
    font-size: 0.95em;
    color: #555;
    position: relative; /* Needed for positioning the dropdown arrow */
  }
  
  .sort-by {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px 12px;
    background-color: #fff;
    position: relative;
  }
  
  .sort-by select {
    border: none;
    background: transparent;
    padding-right: 20px; /* Space for custom arrow */
    -webkit-appearance: none; /* Remove default dropdown arrow (for Webkit browsers) */
    -moz-appearance: none; /* Remove default dropdown arrow (for Firefox) */
    appearance: none; /* Remove default dropdown arrow */
    cursor: pointer;
    font-size: 1em;
    color: #555;
  }
  
  .sort-by select:focus {
    outline: none; /* Remove blue outline on focus */
  }
  
  .dropdown-arrow {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none; /* Allows clicks to pass through to the select element */
    color: #777;
  }
  
  .review-list {
    display: flex;
    flex-direction: column; /* Stacks review cards vertically */
  }
  </style>