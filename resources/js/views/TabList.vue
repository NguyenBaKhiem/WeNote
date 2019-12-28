<template>
  <div class="" id="menu">
    <div class="menu_item" @click.top="$router.push({ name: 'Profile' })">
      <div class="profile"> 
        <template v-if="checkData">
          <div class="info">
            <div class="avatar">
              <img :src="user.avatar" alt="" width="48">
            </div>
            <div class="basic_info">
              <span class="is-block">{{ user.full_name }}</span>
              <small class="is-size-7 ">{{ user.username }}</small>
            </div>
          </div>
        </template>
        <template v-else>
          <div class="animated-background">
            <div class="a"></div>
            <div class="b"></div>
            <div class="c"></div>
            <div class="d"></div>
            <div class="e"></div>
            <div class="f"></div>
            <div class="g"></div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
<script>
  import { mapState } from 'vuex';

  import Const from 'common/Const';
  
  export default {
    data() {
      return {
        isAuthenticated: window.isAuthenticated
      }
    },
    computed: {
      ...mapState(['status', 'user']),
      checkData: function () {
        if (this.status !== 'success') {
          return false
        }
        return true
      }
    },
    methods: {
    }
  }
</script>
<style lang="scss" scoped="">
  @keyframes placeHolderShimmer {
    0%{
      background-position: -468px 0
    }
    100%{
      background-position: 468px 0
    }
  }

  #menu {
    .menu_item {
      cursor: pointer;
      .profile {
        margin: 0 5px;
        .info {
          padding: 10px 5px;
          border-bottom: 1px solid #9e9e9e;
          .avatar {
            position: absolute;
            left: 13px;
            top: 55px;
            transition: none 0s ease 0s;
          }
          .basic_info {
            margin-left: 60px;
          }
        }
        .animated-background {
          animation-duration: 1s;
          animation-fill-mode: forwards;
          animation-iteration-count: infinite;
          animation-name: placeHolderShimmer;
          animation-timing-function: linear;
          background: #f6f7f8;
          background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          background-size: 800px 104px;
          height: 50px;
          position: relative;
          top: 10px;
          left: 5px;
          div {
            background: #fff;
            height: 15px;
            left: 0;
            position: absolute;
            right: 0;
          }
          div.a {
            height: 50px;
            left: 50px;
            right: auto;
            top: 0;
            width: 10px;
          }

          div.b {
            height: 5px;
            left: 60px;
            top: 0px;
          }
          div.c {
            left: 240px;
            top: 5px;
            height: 20px;
          }
          div.d {
            height: 10px;
            left: 60px;
            top: 25px;
          }
          div.e {
            left: 100px;
            top: 35px;
            height: 10px;
          }
          div.f {
            height: 5px;
            left: 60px;
            top: 25px;
          }
          div.g {
            left: 60px;
            top: 45px;
          }
        }
      }
    }
  }
</style>