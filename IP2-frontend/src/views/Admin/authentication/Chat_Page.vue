<template>
    <div class="chat-page-content">
      <h2>Chats</h2>
  
      <div class="chat-area">
        <div class="messages-list">
          <div
            v-for="message in messages"
            :key="message.id"
            :class="['message-card', message.type]"
          >
            <div class="message-bubble">{{ message.text }}</div>
            <span class="message-time">{{ message.time }}</span>
          </div>
        </div>
  
        <div class="message-input-area">
          <input type="text" placeholder="Message" class="message-input" />
          <button class="icon-button">
            <i class="fa-regular fa-face-smile"></i>
          </button>
          <button class="icon-button" @click="triggerFileUpload"> <i class="fa-solid fa-paperclip"></i>
          </button>
          <input
            type="file"
            ref="fileInput"
            style="display: none"
            @change="handleFileUpload"
            accept="image/*" />
        </div>

        
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "ChatPage", // Component name for the chat page
    data() {
      return {
        // Example chat data, in a real app this would come from an API
        messages: [
          {
            id: 1, // Changed sid to id for consistency
            text: "Hello! I was wondering what your operating hours are today. I'm planning to visit with my family, and I want to make sure you're open before heading over. Also, do you have any special offers or promotions today? Thanks.",
            time: "7:15 pm",
            type: "sent",
          },
          {
            id: 2,
            text: "Hi there! We're open from 10 AM to 10 PM today. Yes, we have a special promotion: buy one main course, get 50% off on the second. Valid for today only!",
            time: "7:20 pm",
            type: "received",
          },
          {
            id: 3,
            text: "That's great! One more thing, do you offer any vegetarian dishes? I'm trying to eat more healthy. Thanks!",
            time: "7:25 pm",
            type: "sent",
          },
          {
            id: 4,
            text: "We have several vegetarian options! Feel free to ask our staff for recommendations or check our menu online. Enjoy your meal!",
            time: "7:30 pm",
            type: "received",
          },
        ],
      };
    },
    methods: {
      triggerFileUpload() {
        // Programmatically click the hidden file input
        this.$refs.fileInput.click();
      },
      async handleFileUpload(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
          console.log("Selected file:", file);
          // You would typically upload this file to your server here
          // Example: Using FormData for API upload
          const formData = new FormData();
          formData.append('image', file);
          try {
            const response = await fetch('/api/upload-image', {
              method: 'POST',
              body: formData,
            });
            const result = await response.json();
            console.log('Upload successful:', result);
            // Optionally, add a message to the chat indicating an image was sent
            this.messages.push({
              id: Date.now(), // Unique ID
              text: `Image sent: ${file.name}`,
              time: new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }),
              type: 'sent',
              imageUrl: result.imageUrl // Assuming API returns image URL
            });
          } catch (error) {
            console.error('Error uploading image:', error);
          }
          
          // Reset the file input so the same file can be selected again
          event.target.value = ''; 
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Your existing styles remain here */
  .chat-page-content {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    font-family: "Arial", sans-serif;
    color: #333;
    display: flex;
    flex-direction: column;
    height: calc(
      100vh - 180px
    ); /* Adjust height to fit within the layout, considering header and padding */
  }
  
  h2 {
    font-size: 1.8em;
    color: #2c3e50;
    margin-bottom: 25px;
    text-align: left;
  }
  
  .chat-area {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
  }
  
  .messages-list {
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto; /* Enable scrolling for messages */
    background-color: #f9f9f9;
  }
  
  .message-card {
    display: flex;
    margin-bottom: 15px;
    max-width: 70%; /* Limit bubble width */
    align-items: flex-end; /* Align time to the bottom of the bubble */
  }
  
  .message-card.sent {
    justify-content: flex-start; /* Align sender's messages to left as per image */
  }
  
  .message-card.received {
    justify-content: flex-end; /* Align receiver's messages to right as per image */
    margin-left: auto; /* Push to the right */
  }
  
  .message-bubble {
    background-color: #e0e0e0; /* Default background */
    border-radius: 15px;
    padding: 10px 15px;
    font-size: 0.95em;
    line-height: 1.4;
    word-wrap: break-word;
    color: #333;
  }
  
  .message-card.sent .message-bubble {
    background-color: #e0e0e0; /* Grey for "sent" messages (left side) */
  }
  
  .message-card.received .message-bubble {
    background-color: #a08c79; /* Your brand color for "received" messages (right side) */
    color: white;
  }
  
  .message-time {
    font-size: 0.75em;
    color: #888;
    margin-left: 10px;
    margin-right: 10px;
    white-space: nowrap; /* Prevent time from wrapping */
  }
  
  /* Adjust time alignment for received messages */
  .message-card.received .message-time {
    order: -1; /* Place time before bubble */
    margin-right: 10px;
    margin-left: 0;
  }
  
  .message-input-area {
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: #fff;
    border-top: 1px solid #eee;
  }
  
  .message-input {
    flex-grow: 1;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding: 10px 15px;
    font-size: 1em;
    outline: none;
    margin-right: 10px;
  }
  
  .message-input:focus {
    border-color: #a08c79;
  }
  
  .icon-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    margin: 0 5px;
  }
  
  /* The img rule is no longer directly needed if you are using Font Awesome <i> tags */
  /* If you want to use img tags, make sure to uncomment or re-add the img rules */
  /* .icon-button img {
    width: 24px;
    height: 24px;
    vertical-align: middle;
  } */
  </style>