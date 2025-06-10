<template>
  <div class="chat-page-container">
    <div class="chat-messages-area">
      <div v-for="(messageGroup, index) in chatMessages" :key="index">
        <div class="message-date-divider" v-if="messageGroup.date">
          {{ messageGroup.date }}
        </div>

        <div
          v-for="(message, msgIndex) in messageGroup.messages"
          :key="msgIndex"
          class="message-bubble-wrapper"
        >
          <img
            :src="message.avatar"
            :alt="message.sender + ' Avatar'"
            class="message-avatar"
          />
          <div class="message-content-wrapper">
            <div class="message-header">
              <span class="sender-name">{{ message.sender }}</span>
            </div>
            <div class="message-bubble">
              <p>{{ message.text }}</p>
              <div class="message-info">
                <span class="message-time">{{ message.time }}</span>
                <span class="message-status">
                  <font-awesome-icon
                    :icon="['fas', 'check-double']"
                    class="status-icon"
                  />
                </span>
              </div>
            </div>
            <div class="message-actions">
              <font-awesome-icon :icon="['fas', 'share']" class="action-icon" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="chat-input-area">
      <input
        type="text"
        placeholder="Message"
        class="message-input"
        v-model="newMessageText"
        @keyup.enter="sendMessage"
      />
      <div class="input-actions">
        <i class="far fa-face-smile input-action-icon"></i>
        <i class="fas fa-plus input-action-icon"></i>
        <i
          class="fas fa-paper-plane input-action-icon"
          @click="sendMessage"
          :class="{ 'disabled-icon': newMessageText.trim() === '' }"
        ></i>
      </div>
    </div>
  </div>
</template>

<script>
// 1. Import your actual image assets
import jennyAvatar from "@/assets/images/profile.jpg";

export default {
  name: "Chat_Page",
  data() {
    return {
      newMessageText: "",
      chatMessages: [
        {
          date: "Mon, 6/2",
          messages: [
            {
              sender: "Jenny",
              avatar: jennyAvatar, // Use imported avatar for Jenny
              text: "Hi there! How can I help you today?",
              time: "10:00 AM",
              status: "sent",
            },
          ],
        },
        {
          date: "Mon, 6/2",
          messages: [
            {
              sender: "You",
              avatar: jennyAvatar, // Use imported avatar for "You"
              text: "I have a question about my order.",
              time: "10:01 AM",
              status: "sent",
            },
          ],
        },
      ],
    };
  },
  methods: {
  async sendMessage() {
    // Don't send empty messages
    if (this.newMessageText.trim() === "") return;

    const now = new Date();
    const time = now.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit"
    });

    const todayDate = now.toLocaleDateString("en-US", {
      weekday: "short",
      month: "numeric",
      day: "numeric"
    });

    // Create new message object
    const newMessage = {
      sender: "You",
      avatar: jennyAvatar, // Use your actual avatar import
      text: this.newMessageText,
      time: time,
      status: "sent"
    };

    // Find or create today's message group
    const lastGroup = this.chatMessages[this.chatMessages.length - 1];
    if (lastGroup && lastGroup.date === todayDate) {
      lastGroup.messages.push(newMessage);
    } else {
      this.chatMessages.push({
        date: todayDate,
        messages: [newMessage]
      });
    }

    // Clear input
    this.newMessageText = "";

    // Scroll to bottom after DOM update
    await this.$nextTick();
    this.scrollToBottom();
    
    // Optional: Add message sending animation
    this.addSendingAnimation();
  },

  scrollToBottom() {
    const chatArea = this.$el.querySelector(".chat-messages-area");
    if (chatArea) {
      chatArea.scrollTop = chatArea.scrollHeight;
    }
  },

  addSendingAnimation() {
    // Optional: Add visual feedback
    const planeIcon = this.$el.querySelector(".fa-paper-plane");
    if (planeIcon) {
      planeIcon.classList.add("sending-animation");
      setTimeout(() => {
        planeIcon.classList.remove("sending-animation");
      }, 500);
    }
  }
}};
</script>
<style scoped>
/* Your existing CSS for Chat_Page.vue will remain the same */
/* The .message-avatar style already handles the sizing and circular shape */

.chat-page-container {
  display: flex;
  flex-direction: column;
  height: calc(100vh - 170px);
  background-color: #f8f8f8;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  padding: 0;
  margin: 2%;
}

.chat-messages-area {
  flex-grow: 1;
  padding: 20px;
  overflow-y: auto;
  background-color: #ffffff;
  
}

.message-date-divider {
  text-align: center;
  margin: 20px 0;
  font-size: 0.85em;
  color: #888;
  position: relative;
}

.message-date-divider::before,
.message-date-divider::after {
  content: "";
  position: absolute;
  top: 50%;
  width: 35%;
  height: 1px;
  background-color: #eee;
}

.message-date-divider::before {
  left: 0;
}

.message-date-divider::after {
  right: 0;
}

.message-bubble-wrapper {
  display: flex;
  align-items: flex-start;
  margin-bottom: 15px;
  gap: 15px;
}

.message-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover; /* Ensures the image fills the circular area */
  flex-shrink: 0;
}

.message-content-wrapper {
  display: flex;
  flex-direction: column;
  max-width: 70%;
}

.message-header {
  margin-bottom: 5px;
  font-size: 0.9em;
  color: #666;
  font-weight: bold;
}

.message-bubble {
  background-color: #ffeef2;
  border-radius: 12px;
  padding: 12px 15px;
  position: relative;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.message-bubble p {
  margin: 0;
  font-size: 0.95em;
  line-height: 1.4;
  color: #333;
}

.message-info {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 5px;
  margin-top: 5px;
  font-size: 0.75em;
  color: #999;
}

.message-status .status-icon {
  font-size: 0.8em;
  color: #999;
}

.message-actions {
  align-self: flex-end;
  margin-top: 5px;
  margin-left: 10px;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

.message-bubble-wrapper:hover .message-actions {
  opacity: 1;
}

.message-actions .action-icon {
  font-size: 0.9em;
  color: #888;
  cursor: pointer;
}

/* Chat Input Area */
.chat-input-area {
  background-color: #f0f0f0;
  padding: 15px 20px;
  display: flex;
  align-items: center;
  gap: 15px;
  border-top: 1px solid #e0e0e0;
}

.message-input {
  flex-grow: 1;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 20px;
  font-size: 1em;
  outline: none;
  transition: border-color 0.2s;
}

.message-input:focus {
  border-color: #a08c79;
}

.input-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 10px; /* Optional: adds some minimum space between icons */
  width: 150px; /* Or whatever width you want */
}

.input-action-icon {
  cursor: pointer; /* If clickable */
  font-size: 24px; /* Adjust icon size */
}
</style>
