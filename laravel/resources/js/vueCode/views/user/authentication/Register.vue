<template>
    <div class="flex w-full min-h-screen">
      <!-- Left side image -->
      <div class="hidden lg:block w-2/5 bg-cover bg-center" style="background-image: url('/images/register.png');"></div>

      <!-- Right side form container -->
      <div class="w-full lg:w-3/6 bg-opacity-90 rounded-lg p-20 m-20 lg:p-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Create New Account</h1>
        <form @submit.prevent="handleSubmit" class="space-y-8">
          <div class="flex space-x-6">
            <div class="flex-1">
              <label class="block text-gray-700 text-lg font-semibold mb-3">First Name</label>
              <input v-model="form.firstName" type="text" placeholder="First Name" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none">
            </div>
            <div class="flex-1">
              <label class="block text-gray-700 text-lg font-semibold mb-3">Last Name</label>
              <input v-model="form.lastName" type="text" placeholder="Last Name" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none">
            </div>
          </div>
          <div>
            <label class="block text-gray-700 text-lg font-semibold mb-3">Email</label>
            <input v-model="form.email" type="email" placeholder="Email" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none">
          </div>
          <div>
            <label class="block text-gray-700 text-lg font-semibold mb-3">Password</label>
            <input v-model="form.password" type="password" placeholder="Password" class="shadow-lg appearance-none border rounded-lg w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none">
          </div>
          <button type="submit" class="bg-[#A38D64] hover:bg-[#8F7A56] text-white font-bold py-4 px-8 rounded-lg w-full">
            Create a new account
          </button>
        </form>

        <div class="mt-6 text-center">
          <router-link to="/login" class="text-blue-600 hover:underline">Already have an account? Login</router-link>
        </div>

        <div class="mt-8">
          <div class="flex items-center justify-center mb-6">
            <div class="border-t border-gray-300 flex-grow mr-4"></div>
            <span class="text-gray-500 text-lg">or</span>
            <div class="border-t border-gray-300 flex-grow ml-4"></div>
          </div>
          <div class="flex justify-center space-x-6">
            <a href="https://www.google.com" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg flex items-center justify-center">
              <img src="/images/google.png" alt="Google" class="w-9 h-9">
            </a>
            <a href="https://www.facebook.com" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg flex items-center justify-center">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="w-9 h-9">
            </a>
            <a href="https://telegram.org" target="_blank" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-4 px-8 rounded-lg flex items-center justify-center">
              <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram" class="w-9 h-9">
            </a>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div v-if="showSuccess" class="modal fixed z-50 inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white rounded-lg p-8 text-center w-1/2">
          <h2 class="text-2xl font-semibold text-green-500">Account Created Successfully!</h2>
          <p class="text-lg text-gray-700">Welcome to our platform. You can now log in.</p>
          <router-link to="/login" class="mt-4 inline-block text-blue-500 hover:text-blue-700">Go to Login</router-link>
          <button @click="showSuccess = false" class="mt-2 inline-block bg-red-500 text-white rounded-lg py-2 px-4">Close</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: 'SignUpForm',
    data() {
      return {
        form: {
          firstName: '',
          lastName: '',
          email: '',
          password: ''
        },
        showSuccess: false
      };
    },
    methods: {
      handleSubmit() {
        // Simulate successful form submission
        this.showSuccess = true;

        // TODO: Replace this with actual API request
        console.log("Form submitted:", this.form);
      }
    }
  }
  </script>

  <style scoped>
  .modal-content {
    animation: fadeIn 0.3s ease-in-out;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  </style>
