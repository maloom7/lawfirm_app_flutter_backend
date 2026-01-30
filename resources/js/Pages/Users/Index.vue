<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";

const page = usePage();
const users = page.props.users;
const roles = page.props.roles;

const form = ref({
  id: null,
  name: "",
  email: "",
  password: "",
  role: roles?.[0]?.name ?? "staff",
});

const editing = ref(false);

function reset() {
  form.value = { id: null, name: "", email: "", password: "", role: roles?.[0]?.name ?? "staff" };
  editing.value = false;
}

function edit(u) {
  form.value = {
    id: u.id,
    name: u.name,
    email: u.email,
    password: "",
    role: u.roles?.[0]?.name ?? "staff",
  };
  editing.value = true;
}

function submit() {
  if (editing.value) {
    router.put(route("users.update", form.value.id), form.value, { onSuccess: reset });
  } else {
    router.post(route("users.store"), form.value, { onSuccess: reset });
  }
}

function remove(u) {
  if (!confirm(`Delete ${u.name}?`)) return;
  router.delete(route("users.destroy", u.id));
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Users Management</h1>

    <div class="grid md:grid-cols-3 gap-6">
      <!-- Form -->
      <div class="md:col-span-1 bg-white rounded-xl shadow p-5">
        <h2 class="font-semibold mb-4">{{ editing ? "Edit User" : "Create User" }}</h2>

        <div class="space-y-3">
          <input v-model="form.name" class="w-full rounded-lg border p-2" placeholder="Name" />
          <input v-model="form.email" class="w-full rounded-lg border p-2" placeholder="Email" />

          <input
            v-model="form.password"
            type="password"
            class="w-full rounded-lg border p-2"
            :placeholder="editing ? 'New password (optional)' : 'Password'"
          />

          <select v-model="form.role" class="w-full rounded-lg border p-2">
            <option v-for="r in roles" :key="r.id" :value="r.name">{{ r.name }}</option>
          </select>

          <div class="flex gap-2">
            <button @click="submit" class="flex-1 rounded-lg px-4 py-2 bg-indigo-600 text-white">
              {{ editing ? "Update" : "Create" }}
            </button>
            <button v-if="editing" @click="reset" class="rounded-lg px-4 py-2 border">
              Cancel
            </button>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="md:col-span-2 bg-white rounded-xl shadow p-5">
        <h2 class="font-semibold mb-4">Users</h2>

        <div class="overflow-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="text-left border-b">
                <th class="py-2">Name</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="u in users.data" :key="u.id" class="border-b">
                <td class="py-2">{{ u.name }}</td>
                <td>{{ u.email }}</td>
                <td class="capitalize">{{ u.roles?.[0]?.name ?? "-" }}</td>
                <td class="text-right space-x-2">
                  <button @click="edit(u)" class="px-3 py-1 rounded-lg border">Edit</button>
                  <button @click="remove(u)" class="px-3 py-1 rounded-lg bg-red-600 text-white">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-4 flex gap-2">
          <button
            class="px-3 py-1 rounded border"
            :disabled="!users.prev_page_url"
            @click="router.visit(users.prev_page_url)"
          >
            Prev
          </button>
          <button
            class="px-3 py-1 rounded border"
            :disabled="!users.next_page_url"
            @click="router.visit(users.next_page_url)"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
