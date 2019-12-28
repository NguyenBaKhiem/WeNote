<template>
  <div id="message" v-if="messages.length"  :class="configs.position">
    <div id="message_content" v-for="message in messages" :class="message.type">
      <!-- <strong class="message-type">{{$t('shared_components.alert.'+message.type)}}:</strong> -->
      <span v-if="typeof message.content === 'string'">{{ message.content | upperFirst }}</span>
      <component v-bind:is="message.content" v-bind="message.params" v-if="(typeof message.content !== 'string')">
      </component>
    </div>
  </div>
</template>

<script>
  window.Message = {
    primary: function(content, params, configs){
      window.app.$broadcast('showMessage', 'primary', content, params, configs);
    },
    warning: function(content, params, configs){
      window.app.$broadcast('showMessage', 'warning', content, params, configs);
    },
    success: function(content, params, configs){
      window.app.$broadcast('showMessage', 'success', content, params, configs);
    },
    error: function(content, params, configs){
      window.app.$broadcast('showMessage', 'error', content, params, configs);
    }
  }
  export default {
    data(){
      return {
        messages: [],
        showTime: 3000,
        configs: {}
      }
    },
    methods: {

    },
    created () {
      var self = this;
      
      this.$on('showMessage', (type, content, params, configs) => {
        var newMessage = {
          type    : type,
          content : content,
          params  : params,
          timer   : null
        };

        if (!configs) {
          configs = {
            position: 'center'
          };
        }
        this.configs = Object.assign(this.configs, configs);
        
        newMessage.timer = setTimeout(
          function(){
            self.messages.splice(self.messages.indexOf(newMessage), 1);
          },
          self.showTime
        );

        this.messages.push(newMessage);
      });
    }
  };

</script>
<style lang="scss" scoped>
@import "../../sass/_variables.scss";
#message {
  /*display      : none;*/
  position     : fixed;
  min-height   : 60px;
  min-width    : 370px;
  line-height: 9px;
  z-index      : 10000;
  font-size    : 14px;
  padding      : 15px;
  border-radius: 5px;
  &.center {
    margin-left: -143.5px;
    left: 50%;
    text-align: 50%;
    color: red;
    margin-top: -37.5px;
    top: 50%;
  }

  &.bottom_left {
    bottom: 10px;
    right: 40px;
  }

  &.top_left {
    top: 30px;
    right: 0px;
  }


  #message_content {
    max-width: 400px;
    padding: 25px 20px 25px 20px;
    margin-top: 20px;
    text-align: center;
    word-break: break-all;
    color: $color_white;
    line-height: 1.2;
    &.primary {
      background-color: $background_color_primary_message;
      .message-type {
        padding-left: 20px;
      }
      strong,span{
        color: $color_primary_text_message;
      }
    }
    &.success {
      background-color: $color_caribbean_green;
     .message-type {
      padding-left: 20px;
      }
      strong,span{
        color: $color_white;
      }
    }
    &.warning {
      background-color: $background_color_warning_message;
      .message-type {
        padding-left: 20px;
      }
      strong,span{
        color: $color_warning_text_message;
      }
    }
    &.error {
      background-color: $red;
      .message-type {
        padding-left: 20px;
      }
      strong,span{
        color: $color_white;
      }
    }
  }
}
</style>
