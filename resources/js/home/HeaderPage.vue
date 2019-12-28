<template>
  <div>
    <b-navbar type="is-dark" id="main_navbar" :class="{nav_saerch : isSearchActive}">
      <template slot="brand">
        <b-navbar-item tag="router-link" to="/" class="is-hidden-mobile">
          <img
          src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
          alt="Lightweight UI components for Vue.js based on Bulma"
          >
        </b-navbar-item>
        <b-navbar-item tag="router-link" to="/" class="is-hidden-tablet">
          <h2 class="is-light is-size-5" v-if="!isSearchActive">{{ $route.name }}</h2>
        </b-navbar-item>
        <b-navbar-item tag="div" class="is-pulled-right box_search has-text-right">
          <p class="control is-small has-icons-left p_search" :class="isSearchActive ? '' : 'hidden'">
            <input class="input is-small is-rounded" type="text" placeholder="Password" id="focus_input_search">
            <span class="icon is-small is-left">
              <b-icon icon="search" size="is-small" class="search_icon"></b-icon>
            </span>
          </p>       
          <label class="focus_input_search">
            <b-icon size="is-small"
                    :icon="isSearchActive ? 'times': 'search'"
                    :class="isSearchActive ? 'times': 'search'"
                    @click.native="isSearchActive = !isSearchActive" 
                    @click="isSearchActive = false">
            </b-icon>
          </label>
        </b-navbar-item>
      </template>
      <template slot="buger" :isOpened="false"></template>
      <template slot="start">
        <b-navbar-item tag="router-link" to="/">
          Home
        </b-navbar-item>
        <b-navbar-item tag="router-link" to="/documents">
          Documentation
        </b-navbar-item>
      </template>

      <template slot="end">
        <template v-if="isAuthenticated">
          <b-dropdown                    
              v-model="navigation"
              position="is-bottom-left"
              aria-role="menu"
              class="is-hidden-touch"
              id="messenger_dropdown">
            <b-navbar-item class="nav-icon"
                slot="trigger">
              <b-icon icon="comments"></b-icon>
            </b-navbar-item>
            <template v-for="(item, index) in items">
              <b-dropdown-item :value="`chennal{$index}`">
                <b-icon icon="cog"></b-icon>
                Settings
              </b-dropdown-item>
              <hr class="dropdown-divider" aria-role="menuitem" v-show="index < items.length - 1">
            </template>
          </b-dropdown>
          <b-dropdown                    
              v-model="navigation"
              position="is-bottom-left"
              aria-role="menu">
            <b-navbar-item class="nav_item_edit"
                slot="trigger"
                role="button">
              <span class="has-text-success">{{ user.full_name }}</span>
            </b-navbar-item>
            <b-dropdown-item has-link aria-role="menuitem">
              <a href="https://google.com" target="_blank">
                <b-icon icon="link"></b-icon>
                  Google (link)
              </a>
            </b-dropdown-item>
            <b-dropdown-item has-link value="comments" aria-role="menuitem">
              <router-link :to="{ name: 'Messenger' }" exact>
                <b-icon icon="comments"></b-icon>
                <span class="badage">6</span>
                Messenger
              </router-link>
            </b-dropdown-item>
            <hr class="dropdown-divider" aria-role="menuitem">
            <b-dropdown-item value="settings">
              <b-icon icon="cog"></b-icon>
              Settings
            </b-dropdown-item>
            <b-dropdown-item has-link value="logout" aria-role="menuitem">
              <a href="" @click.stop="onClickedLogout()">
                <b-icon icon="sign-out-alt"></b-icon>
                {{ $t("common.logout") }}
              </a>
            </b-dropdown-item>
          </b-dropdown>
        </template>
        <template v-else>
          <b-navbar-item tag="div">
            <div class="buttons">
              <a class="button is-light" @click.stop="$router.push({ name: 'Sign Up' })">
                <span class="icon">
                  <b-icon
                    icon="user-plus"
                    size="is-small">
                  </b-icon>
                </span>
                <span :class="{'active': $route.name === 'Sign Up'}">{{ $t("common.register") }}</span>
              </a>
            </div>
          </b-navbar-item>
          <b-navbar-item tag="div">
            <div class="buttons">
              <a class="button is-primary" @click.stop="$router.push({ name: 'Login' })">
                <span class="icon">
                  <b-icon
                    icon="sign-in-alt"
                    size="is-small">
                  </b-icon>
                </span>
                <span :class="{'active': $route.name === 'Login'}">{{ $t("common.login") }}</span>
              </a>
            </div>
          </b-navbar-item>
        </template>
      </template>
    </b-navbar>
    <nav class="navbar is-link is-fixed-bottom is-hidden-tablet" role="navigation" id="bottom_navbar">
      <div class="navbar-brand">
        <router-link :to="{ name: 'Home' }" active-class="active"
                      class="navbar-item is-expanded  is-block has-text-centered">
          <b-icon icon="newspaper" pack="far"></b-icon>
        </router-link>
        <router-link :to="{ name: 'Messenger' }" active-class="active"
                      class="navbar-item is-expanded  is-block has-text-centered">
          <b-icon icon="facebook-messenger" pack="fab"></b-icon>
        </router-link>
        <router-link :to="{ name: 'Notifications' }" active-class="active"
                      class="navbar-item is-expanded  is-block has-text-centered">
          <b-icon icon="bell"></b-icon>
        </router-link>
        <router-link :to="{ name: 'Menu' }" active-class="active"
                      class="navbar-item is-expanded  is-block has-text-centered">
          <b-icon icon="list"></b-icon>
        </router-link>
      </div>
    </nav>
    <b-modal id="list_search"
              has-modal-card full-screen
              :active.sync="isSearchActive"
              :can-cancel="false">
      <template>
        <div class="modal-card">
          <section class="modal-card-body">
            <b-field label="Email">
              <b-input
                      type="email"
                      value="414124124"
                      placeholder="Your email"
                      required>
              </b-input>
            </b-field>

            <b-field label="Password">
              <b-input
                      type="password"
                      value="pass214124word"
                      password-reveal
                      placeholder="Your password"
                      required>
              </b-input>
            </b-field>

          <b-checkbox>Remember me</b-checkbox>
        </section>
        <footer class="modal-card-foot">
          <button class="button" type="button" @click="isSearchActive = false">Close</button>
          <button class="button is-primary">Login</button>
        </footer>
        </div>
      </template>
    </b-modal>

  </div>
</template>
<script>
  import { mapState } from 'vuex';
  import AuthenticationUtils from 'common/AuthenticationUtils';

  import Const from 'common/Const';
  
  export default {
    data() {
      return {
        isAuthenticated: window.isAuthenticated,
        isTabListActive: false,
        isSearchActive: false,
        navigation: 'home',
        items: ['1', '2', '3', '4', '5'],
        isSearchActive: false
      }
    },
    computed: {
      ...mapState(['user', 'usersOnline']),
    },
    methods: {
      onClickedLogout() {
        AuthenticationUtils.removeAuthenticationData();
          return window.location = '/';
      }
    },
    watch:{
      $route (to, from) {
        this.show = false;
      }
    } 
  }
</script>
<style lang="scss" scoped>
@import "../../sass/common";
#main_navbar {
  -webkit-transition: background-color 2500ms ease-out 1s;
  -moz-transition: background-color 2500ms ease-out 1s;
  -o-transition: background-color 2500ms ease-out 1s;
  -ms-transition: background-color 2500ms ease-out 1s;
  transition: background-color 2500ms ease-out 1s;
  .has-link, .dropdown-item {
    span.icon {
      vertical-align: bottom;
    }
  }
  .navbar-end {
    a.navbar-item:focus,
    a.navbar-item:focus-within,
    a.navbar-item:hover,
    a.navbar-item.is-active {
      background-color: #292929;
    }
  }
  .box_search {
    cursor: pointer;
    display: none;
  }
  .badage {
    position: absolute;
    border: 0px solid red;
    border-radius: 20px;
    height: 15px;
    width: 15px;
    padding: 0px 0px 0px 5px;
    top: 5px;
    left: 27px;
    background-color: red;
    font-size: 11px;
  }
}
#main_navbar.nav_saerch {
  background-color: #23d160;
  -webkit-transition: background-color 1000ms ease-in-out;
  -moz-transition: background-color 1000ms ease-in-out;
  -o-transition: background-color 1000ms ease-in-out;
  -ms-transition: background-color 1000ms ease-in-out;
  transition: background-color 1000ms ease-in-out;
}
@media only screen and (max-width: 1024px) {
  #main_navbar {
    .navbar-menu.is-active {
      .navbar-item:hover {
        background-color: #fafafa;
      }
    }
    .badage {
      top: 15px;
      left: 35px;
    }
  }
}
</style>
<style lang="scss">
  #main_navbar {
    min-height: 2rem;
    height: 45px;
    .navbar-brand, .navbar-brand:focus, .navbar-brand:active, .navbar-brand:hover {
      min-height: 2rem;
      height: 45px;
    }
    .nav-item, .nav-item:active, .nav-item:hover, .nav-item:focus {
      min-height: 2rem;
      height: 45px;
    }
    .navbar-burger, .navbar-burger:active, .navbar-burger:hover, .navbar-burger:focus {
      min-height: 2rem;
      height: 45px;
    }
  }
  @media only screen and (max-width: 768px) {
    #main_navbar {
      .navbar-brand {
        .navbar-burger, .navbar-burger:active, .navbar-burger:hover, .navbar-burger:focus {
          pointer-events: none;
          display: none;
        }
        .box_search {
          display: inline-block;
          position: absolute;
          right: 0;
          width: 100%;
          .control {
            display: inline-block;
          }
          span {
            vertical-align: middle;
          }
          .search_icon {
            svg {
              position: relative;
              left: 5px;
            }
          }
          .p_search {
            display: inline-block;
            width: 768px;
            max-width: 100%;
            transition: width 3.25s ease-out, opacity .75s;
            -webkit-transition: width 3.25s ease-out, opacity .75s;
            -moz-transition: width 3.25s ease-out, opacity .75s;
            -o-transition: width 3.25s ease-out, opacity .75s;
            input:focus, input:active {
              border: none;
              box-shadow: none;
              -webkit-box-shadow: none;
              -moz-box-shadow: none;
              -o-box-shadow: none;
            }
          }
          .p_search:not(.hidden) {
            padding-right: 20px;
          }
          .p_search.hidden {
            pointer-events: none;
            min-width: 30px;
            width: 30px;
            max-width: 50%;
            opacity: 0;
            transition: width 1.75s ease-in, opacity 3s;
            -webkit-transition: width 1.75s ease-in, opacity 3s;
            -moz-transition: width 1.75s ease-in, opacity 3s;
            -o-transition: width 1.75s ease-in, opacity 3s;
          }
          label[class="focus_input_search"] {
            cursor: pointer;
            span {
              position: absolute;
              top: 12px;
              right: 15px;
              padding: 10px;
              
            }
            span.search {
              top: 11px;
              border-radius: 15px;
              background-color: white;
              color: #b1b1b1;
              border: 1px solid white;
            }
          }
          .cancel_search {
            position: absolute;
          }
        }
      }
    }
  }
  #user_menu {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    max-height: calc(100vh - 30px);
    margin: 0;
    background-color: #ffffff;
    .modal-background {
      display: none;
      background-color: initial;
    }
  }
  #messenger_dropdown {
    .nav-icon {
      color: whitesmoke;
    }
    .dropdown-menu {
      .dropdown-item.is-active {
        background-color: white;
        color: #0a0a0a;
      }
      .dropdown-item.is-active:hover {
        background-color: whitesmoke;
        color: #0a0a0a;
      }
    }
  }
  @media only screen and (min-width: 768px) {
    #messenger_dropdown {
      .nav-icon {
        color: whitesmoke;
      }
      .dropdown-menu {
        max-width: 300px;
        width: 100vw;
      }
    }
  }
  a.router-link-exact-active.active:after {
    content: "";
    position: absolute;
    left: 10px;
    bottom: 50px;
    width: calc(100% - 20px);
    height: 3px;
    background-color: #30caa0;
    margin: auto;
    border-radius: 0 0 12px 12px;
  }
  #bottom_navbar {
    min-height: unset;
    background-color: whitesmoke;
    border-top: 1px solid #666D6D;
    height: 30px;
    .navbar-item {
      padding: 3px 5px;
      .icon {
        svg {
          color: #5a5a5aa5;
        }
      }
    }
    .navbar-item:hover, .navbar-link:focus-within {
      background-color: #e4e4e4;
    }
    .navbar-item:focus {
      background-color: whitesmoke;
      outline-color: whitesmoke;
    }
  }
  #list_search {
    position: fixed;
    top: 45px;
  }
</style>
