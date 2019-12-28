<template>
  <section class="hero is-success is-fullheight bg-only-mobile">
    <b-navbar type="is-success" id="navbar">
      <template slot="brand">
        <b-navbar-item tag="router-link" to="/">
          <img
          src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
          alt="Lightweight UI components for Vue.js based on Bulma"
          >
        </b-navbar-item>
      </template>
      <template slot="start">
        <b-navbar-item href="#">
          Home
        </b-navbar-item>
        <b-navbar-item href="#">
          Documentation
        </b-navbar-item>
      </template>

      <template slot="end">
      </template>
    </b-navbar>
    <div class="hero-body">
      <div class="container has-text-centered">
        <main id="contain">
          <div class="auth-container">
            <slot name="title"></slot>
            <div class="column is-6 is-offset-3">
              <slot>
              </slot>
            </div>
            <p class="has-text-grey">
              <template v-if="$route.name === 'Sign Up'">
                <router-link :to="{ name: 'Login' }">Login</router-link> &nbsp;·&nbsp;
                <a href="../">Forgot Password</a> &nbsp;·&nbsp;
              </template>
              <template v-if="$route.name === 'Login'">
                <router-link :to="{ name: 'Sign Up' }">Sign Up</router-link> &nbsp;·&nbsp;
                <a href="../">Forgot Password</a> &nbsp;·&nbsp;
              </template>
              <template v-if="$route.name === 'Forgot Password'">
                <router-link :to="{ name: 'Login' }">Login</router-link> &nbsp;·&nbsp;
                <router-link :to="{ name: 'Sign Up' }">Sign Up</router-link> &nbsp;·&nbsp;
              </template>
              <a href="../">Need Help?</a>
            </p>
          </div>
        </main>
      </div>
    </div>
  </section>

</template>
<style lang="scss">
  .view_login {
    .notification {
      padding: 2rem 1rem;
      background-color: #f6f5f552;
      .media-content {
        overflow-x: initial;
      }
    }
    .navbar-burger {
      display: none;
    }
    .loading-overlay.is-active {
      z-index: 20;
    }
  }
  @media only screen and (min-width: 678px) {
    .view_login {
      .bg-only-mobile {
        background-image: none !important;
      }
    }
  }
</style>