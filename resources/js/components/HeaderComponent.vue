<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <a class="navbar-brand" href="/">W PROJECT</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <router-link class="nav-link" to="/home">Home</router-link>
                  </li>
                  <li class="nav-item">
                      <router-link class="nav-link" to="/profile">Profile</router-link>
                  </li>
              </ul>
              <div>
                  <button @click="logout" class="btn btn-danger">Logout</button>
              </div>
          </div>
      </div>
  </nav>
</template>

<script>
export default {
  methods: {
      async logout() {
          try {
              await fetch('/logout', {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                      'Content-Type': 'application/json',
                  },
              });
              // Redirigir al login después de cerrar sesión
              window.location.href = '/login';
          } catch (error) {
              console.error('Logout failed:', error);
          }
      },
  },
}
</script>

<style scoped>
.navbar {
  margin-bottom: 20px;
}
</style>
