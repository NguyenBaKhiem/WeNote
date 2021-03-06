<template>
  <div class="view_login">
    <section class="hero is-success is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
          <h3 class="title has-text-grey">Login</h3>
          <b-notification :closable="false" class="box">
            <figure class="avatar has-text-centered">
              <img src="https://placehold.it/128x128">
            </figure>
            <span class="invalid-feedback has-text-centered" v-if="errors.has('login_error')">
              {{ errors.first('login_error') }}
            </span>

            <div class="input-group last has-text-centered" v-show="errors.has('error')">
              <span class="invalid-feedback"> {{ errors.first('error') }} </span>
            </div>
            <div class="field">
              <div class="control">
                <b-input icon="user"
                        v-model="username"
                        @focus="resetError"
                        :placeholder="$t('common.email_placeholder')"
                        :class="{ error: errors.has('username') }"
                        name="username"
                        data-vv-validate-on="none"
                        v-validate="'required'"
                        type="text"></b-input>
              </div>
              <span class="invalid-feedback" v-if="errors.has('username')">
                {{ errors.first('username') }}
              </span>
            </div>

            <div class="field">
              <div class="control">
                <b-input icon="key"
                        password-reveal
                        v-model="password" 
                        @focus="resetError"
                        :placeholder="$t('common.password')"
                        :class="{ error: errors.has('password') }"
                        name="password"
                        data-vv-validate-on="none"
                        v-validate="'required|min:6|max:72'"
                        type="password"></b-input>
              </div>
              <span class="invalid-feedback" v-if="errors.has('password')">
                {{ errors.first('password') }}
              </span>
            </div>
            <div class="field">
              <b-checkbox name="remember"
                type="is-success"
                true-value="Yes"
                false-value="No">
                Remember me
            </b-checkbox>
            </div>
            <div class="buttons">
              <b-button :disabled="isSubmitting" @click="submit" type="is-info">
                {{ getSubmitName('Login') }}
              </b-button>
            </div>
            <b-loading :is-full-page="isFullPage" :active.sync="isSubmitting" :can-cancel="false"></b-loading>
          </b-notification>
        </div>
      </div>
    </div>
  </section>
  </div>

</div>
</template>
<script>
  import rf from 'requestfactory';
  import AuthenticationUtils from 'common/AuthenticationUtils';
  import Message from '../../components/Message';

  export default {
    data() {
      return {
        username: '',
        password: '',
        modalMessage: '',
        isConfirming: false,
        isFullPage: true,
        host: window.location.origin,
      }
    },
    components: {
      Message,
    },
    props: {
      confirmationCode: { type: String, default: '' },
      deviceCode: { type: String, default: '' },
    },
    computed: {
      isSubmitable() {
        return !this.isSubmitting && !this.isConfirming;
      },
    },
    methods: {
      openLoading() {
        this.isSubmitting = true
        setTimeout(() => {
          this.isSubmitting = false
        }, 10 * 1000)
      },
      resetError () {
        this.errors.clear();
      },
      confirm () {
        this.isConfirming = true;
        if (this.isSubmitting) {
          return;
        }
        this.startSubmit();
        rf.getRequest('UserRequest').confirm(this.confirmationCode)
          .then(response => {
            this.isConfirming = false;
            this.endSubmit();
            this.showConfirmedModal(true);
          })
          .catch(error => {
            this.isConfirming = false;
            this.endSubmit();
            this.showConfirmedModal(false);
          });
      },
      activeDevice () {
        if (this.isSubmitting) {
          return;
        }
        this.startSubmit();
        rf.getRequest('UserRequest').grantAccessDevice(this.deviceCode)
          .then(response => {
            this.endSubmit();
            this.showActiveDeviceModal(response.data.result || {});
          })
          .catch(error => {
            this.endSubmit();
            this.showActiveDeviceModal(false);
          });
      },
      async submit () {
        await this.$validator.validateAll();
        if (this.errors.any()) {
          return;
        }

        if (!this.isSubmitable) {
          return;
        }

        this.resetError();
        this.startSubmit();
        rf.getRequest('UserRequest').login(this.username, this.password)
          .then(response => {
            this.endSubmit();
            AuthenticationUtils.saveAuthenticationData(response);
            const destination = this.$route.query.destination || '/';
            window.location.href = destination; 
          })
          .catch(error => {
            this.endSubmit();
            this.errors.add({field: 'error', msg: error.response.data.message});
          });
      },

      showConfirmedModal (isSucceed) {
        this.modalMessage = isSucceed ? this.$t('login.confirm_success') : this.$t('login.confirm_failed');
        window.CommonModal.show('login-succeed-modal');
      },

      showActiveDeviceModal (result) {
        this.modalMessage = result ? this.$t('login.active_device_success', result) : this.$t('login.active_device_failed');
        window.CommonModal.show('login-succeed-modal');
      },
    },
    mounted() {
      window.addEventListener('keyup', (event) => {
        if (event.keyCode === 13) { 
          this.submit();
        }
      });
      if (this.confirmationCode) {
        return this.confirm();
      }
      if (this.deviceCode) {
        return this.activeDevice();
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import "../../../sass/common.scss";
  .verify-box {
    height: 50px;
    text-align: center;
    border: 1px solid $color-blue-cerulean-light;
    padding-left: 0 !important;
    // background-color: $color-link-water;
    line-height: 30px;
    .icon-home2 {
      padding-right: 10px;
    }
  }  
  .left {
    float: left;
  }
  .f-13 {
    font-size: 13px;
    font-weight: normal !important;
  }
  .mb-5 {
    margin-bottom: 5px;
  }
  .login_box {
    .link-primary {
      opacity: 0.8;
      color: $color_white;
      font-size: $font_root;
      line-height: 20px;
      display: block;
      width: 100%;
    }
  }
  .invalid-feedback {
    color: red;
    font-size: 12px;
  }
</style>
