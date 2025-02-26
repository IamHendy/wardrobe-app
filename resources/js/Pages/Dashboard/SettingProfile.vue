<template>
  <div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold">General Settings</h1>
    <p class="text-gray-700 mt-2">Manage your application settings below.</p>
    
    <form @submit.prevent="saveSettings" class="mt-6">
      <div class="mb-4">
        <label class="block text-gray-600">Display Name:</label>
        <input
          type="text"
          v-model="settings.displayName"
          class="w-full p-2 border rounded-md"
        />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-600">Email:</label>
        <input
          type="email"
          v-model="settings.email"
          class="w-full p-2 border rounded-md"
        />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-600">Theme:</label>
        <select
          v-model="settings.theme"
          class="w-full p-2 border rounded-md"
        >
          <option value="light">Light</option>
          <option value="dark">Dark</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-600 mb-1">Notifications:</label>
        <div class="flex items-center">
          <input
            type="checkbox"
            id="notifications"
            v-model="settings.notifications"
            class="mr-2"
          />
          <label for="notifications" class="text-gray-600">
            Enable Notifications
          </label>
        </div>
      </div>
      
      <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">
        Save Settings
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue';

const settings = reactive({
  displayName: 'John Doe',
  email: 'johndoe@example.com',
  theme: 'light',
  notifications: true,
});

const saveSettings = () => {
  // Here you could call an API to persist the settings
  console.log('Settings saved:', settings);
  // For now, we simply show an alert
  alert('Settings saved successfully!');
};
</script>
