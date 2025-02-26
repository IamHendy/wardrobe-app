<script setup>
import { ref } from "vue";
import RegisterModal from '../Pages/Components/RegisterModal.vue';

const showRegisterModal = ref(false);
</script>

<template>
  <Head title="Wardrobe Manager" />

  <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <!-- Hero Section -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">
        Wardrobe <span class="text-pink-500">Manager</span>
      </h1>

      <img 
        src="../../../public/images/wardrobe 2.jpg" 
        alt="Wardrobe Image" 
        class="mx-auto my-6 rounded-lg shadow-md w-4/5 sm:w-3/5"
      />

      <p class="text-lg text-gray-700 mt-4 leading-relaxed">
        Effortlessly organize your wardrobe, track your outfits, and plan your styles with ease.  
        Never forget what you own and make the most out of your fashion collection.
      </p>

      <button
        @click="showRegisterModal = true"
        class="mt-6 bg-gradient-to-r from-pink-500 to-black text-white px-8 py-3 text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition-transform duration-300"
      >
        Get Started - Register Now
      </button>
    </div>

    <!-- Features Section -->
    <div class="mt-10 bg-gray-100 p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Features</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex items-start space-x-3">
          <span class="text-pink-500 text-2xl">✔</span>
          <p class="text-gray-700"><strong>Outfit Tracking:</strong> Keep a log of your outfits to plan ahead.</p>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-pink-500 text-2xl">✔</span>
          <p class="text-gray-700"><strong>Wardrobe Organization:</strong> Categorize clothes by type, color, and occasion.</p>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-pink-500 text-2xl">✔</span>
          <p class="text-gray-700"><strong>Favorite Section:</strong> Keep a record of your favorite outfits.</p>
        </div>
        <div class="flex items-start space-x-3">
          <span class="text-pink-500 text-2xl">✔</span>
          <p class="text-gray-700"><strong>General Overview:</strong> Get statistics of your wardrobe.</p>
        </div>
      </div>
    </div>

    <!-- Extra Image Section -->
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-lg">
      <img 
        src="../../../public/images/wardrobe.jpg" 
        alt="Wardrobe Image" 
        class="mx-auto my-6 rounded-lg shadow-md w-4/5 sm:w-3/5"
      />

      <!-- Additional Information -->
      <div class="text-center mt-6">
        <h2 class="text-2xl font-bold text-gray-900">Why Choose Our Wardrobe Manager?</h2>
        <p class="text-lg text-gray-700 mt-4 leading-relaxed">
          Our wardrobe management system is designed to bring efficiency, ease, and style into your life.  
          Whether you are a fashion enthusiast or just looking for an easy way to organize your clothes,  
          our system provides the perfect solution.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6 mb-12 pb-4">
          <div class="p-4 bg-gray-100 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-pink-500">Smart Suggestions</h3>
            <p class="text-gray-700 mt-2">Get outfit recommendations based on the weather and your preferences.</p>
          </div>
          <div class="p-4 bg-gray-100 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-pink-500">Style Insights</h3>
            <p class="text-gray-700 mt-2">Analyze your clothing trends and improve your fashion sense.</p>
          </div>
          <div class="p-4 bg-gray-100 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-pink-500">Easy Wardrobe Planning</h3>
            <p class="text-gray-700 mt-2">Plan your outfits in advance and never waste time deciding what to wear.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Register Modal -->
    <RegisterModal v-if="showRegisterModal" @close="showRegisterModal = false" />
  </div>

  <!-- Footer -->
  <footer class="bg-black text-white py-6 mt-12">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-xl font-semibold">Wardrobe Manager</h2>
      <p class="mt-2 text-gray-400">Simplify your wardrobe, elevate your style.</p>

      <div class="flex justify-center space-x-6 mt-4">
        <a href="#" class="hover:text-pink-500 transition">Facebook</a>
        <a href="#" class="hover:text-pink-500 transition">Instagram</a>
        <a href="#" class="hover:text-pink-500 transition">Twitter</a>
      </div>

      <p class="mt-4 text-gray-500 text-sm">&copy; 2025 Wardrobe Manager. All rights reserved.</p>
    </div>
  </footer>
</template>
