<template>
    <div class="reset-password-container">
      <div class="reset-password-box">
        <h1>Reset Your Password</h1>
        <p>Please check your email for the verification code. Enter it below along with your new password.</p>
        <form @submit.prevent="resetPassword">
          <div class="input-group">
            <label for="verificationCode">Verification Code</label>
            <input
              type="text"
              id="verificationCode"
              v-model="verificationCode"
              placeholder="Enter verification code"
              required
            />
          </div>
  
          <div class="input-group">
            <label for="newPassword">New Password</label>
            <input
              type="password"
              id="newPassword"
              v-model="newPassword"
              placeholder="Enter new password"
              required
            />
          </div>
  
          <div class="input-group">
            <label for="confirmPassword">Confirm New Password</label>
            <input
              type="password"
              id="confirmPassword"
              v-model="confirmPassword"
              placeholder="Confirm new password"
              required
            />
          </div>
  
          <button type="submit" class="submit-reset-button">Reset Password</button>
        </form>
  
        <div class="links">
          <a href="#" @click.prevent="resendCode">Resend Code?</a>
          <router-link to="/sign-in">Back to Login</router-link>

        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ResetPasswordVerifySection',
    data() {
      return {
        verificationCode: '',
        newPassword: '',
        confirmPassword: ''
      };
    },
    methods: {
      resetPassword() {
        if (this.newPassword !== this.confirmPassword) {
          alert("New password and confirm password do not match!");
          return;
        }
  
        // In a real application, you would send this data to your backend
        // for verification and password update.
        console.log('Attempting to reset password with:', {
          code: this.verificationCode,
          newPassword: this.newPassword
        });
  
        // Example: Call an API
        // axios.post('/api/password/reset', {
        //   token: this.verificationCode, // Often, the code is referred to as a 'token'
        //   email: this.userEmail, // You might need to pass the user's email too
        //   password: this.newPassword,
        //   password_confirmation: this.confirmPassword
        // })
        //   .then(response => {
        //     alert('Your password has been reset successfully! You can now log in.');
        //     console.log('Password reset successful:', response.data);
        //     // Redirect to login page
        //     this.goToLogin();
        //   })
        //   .catch(error => {
        //     console.error('Password reset failed:', error.response ? error.response.data : error.message);
        //     alert('Password reset failed. Please check your code and try again.');
        //   });
      },
      resendCode() {
        console.log('Resending verification code...');
        // In a real application, you'd trigger an API call to resend the code
        // This usually requires knowing the user's email again, which you might
        // pass to this component as a prop or retrieve from storage.
        // Example: axios.post('/api/password/email', { email: this.userEmail })
        //   .then(() => alert('Verification code resent!'))
        //   .catch(() => alert('Could not resend code. Please try again later.'));
      },
      goToLogin() {
        console.log('Go to Login page');
        // Programmatically navigate to your login route
        // Example: this.$router.push('/login');
      }
    }
  };
  </script>
  
  <style scoped>
  /* Styling consistent with previous components */
  .reset-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #F8F4ED; /* Consistent light background */
    background-image: url('path/to/your/background-image.jpg'); /* Optional: Add a background image */
    background-size: cover;
    background-position: center;
  }
  
  .reset-password-box {
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white card */
    padding: 40px 50px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
    max-width: 500px; /* Slightly wider for multiple inputs */
    box-sizing: border-box;
    backdrop-filter: blur(5px); /* Optional: Frosted glass effect */
    -webkit-backdrop-filter: blur(5px);
  }
  
  h1 {
    font-size: 2.2em;
    margin-bottom: 20px;
    color: #574E4A;
  }
  
  p {
    font-size: 1em;
    color: #666;
    margin-bottom: 30px;
    line-height: 1.5;
  }
  
  .input-group {
    margin-bottom: 20px; /* Slightly reduced margin for more inputs */
    text-align: left;
  }
  
  .input-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #574E4A;
  }
  
  .input-group input {
    width: 100%;
    padding: 15px 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1.1em;
    box-sizing: border-box;
    background-color: #fff;
  }
  
  .submit-reset-button {
    background-color: #A08C79;
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
    margin-top: 20px;
  }
  
  .submit-reset-button:hover {
    background-color: #8D7A65;
  }
  
  .links {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    font-size: 0.95em;
  }
  
  .links a {
    color: #574E4A;
    text-decoration: none;
    font-weight: bold;
  }
  
  .links a:hover {
    text-decoration: underline;
  }
  </style>