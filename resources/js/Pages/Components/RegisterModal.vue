<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "./TextInput.vue"; // Adjust the path if necessary

// Allow the parent to close the modal
const emit = defineEmits(["close"]);

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
  avatar: null,
  preview: null,
});

const change = (e) => {
  form.avatar = e.target.files[0];
  form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
  form.post(route("register"), {
    onError: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <!-- Modal Background -->
  <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
    <!-- Modal Container -->
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full relative">
      <!-- Close Button -->
      <button
        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800"
        @click="$emit('close')"
      >
        &times;
      </button>

      <h1 class="title text-center text-xl font-bold text-pink-500">Register a new account</h1>

      <div class="mt-4">
        <form @submit.prevent="submit">
          <!-- Upload Avatar -->
          <div class="grid place-items-center">
            <div class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300">
              <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                <span class="bg-white/70 pb-2 text-center">Avatar</span>
              </label>
              <input type="file" @input="change" id="avatar" hidden />
              <img
                class="object-cover w-28 h-28"
                :src="form.preview ?? 'storage/avatars/default.jpeg'"
                alt="avatar"
              />
            </div>
            <p class="error mt-2 text-red-500">{{ form.errors.avatar }}</p>
          </div>
          <!-- End Upload Avatar -->

          <!-- Name Input -->
          <TextInput name="name" v-model="form.name" :message="form.errors.name" />

          <!-- Email Input -->
          <TextInput
            name="email"
            type="email"
            v-model="form.email"
            :message="form.errors.email"
          />

          <!-- Password Input -->
          <TextInput
            name="password"
            type="password"
            v-model="form.password"
            :message="form.errors.password"
          />

          <!-- Password Confirmation Input -->
          <TextInput
            name="confirm password"
            type="password"
            v-model="form.password_confirmation"
          />

          <div class="mt-4 text-center">
            <p class="text-slate-600 mb-2">
              Already a user?
              <a :href="route('login')" class="text-pink-500">Login</a>
            </p>
            <button class="primary-btn bg-gradient-to-r from-pink-500 to-black text-white" :disabled="form.processing" type="submit">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
