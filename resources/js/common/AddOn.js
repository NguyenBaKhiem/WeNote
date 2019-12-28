import Vue from 'vue';
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import 'nprogress/nprogress.css';

import { library } from '@fortawesome/fontawesome-svg-core';
import { 
        faCheck,
        faTimes,
        faSearch,
        faSignInAlt,
        faSignOutAlt,
        faUserPlus,
        faEllipsisH,
        faUser,
        faKey,
        faEye,
        faEyeSlash,
        faCog,
        faLink,
        faComments,
        faCaretDown,
        faList,
        faBell,
        faUserCircle
      } from "@fortawesome/free-solid-svg-icons";
import {
        faNewspaper as farNewspaper
      } from '@fortawesome/free-regular-svg-icons';
import {
        faFacebookMessenger as fabFacebookMessenger
      } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(
        faCheck,
        faTimes,
        faSearch,
        faSignInAlt,
        faSignOutAlt,
        faUserPlus,
        faEllipsisH,
        faUser,
        faKey,
        faEye,
        faEyeSlash,
        faCog,
        faLink,
        faComments,
        faCaretDown,
        faList,
        faBell,
        faUserCircle
      );
library.add(
        farNewspaper
      );
library.add(
        fabFacebookMessenger
      );
Vue.component('vue-fontawesome', FontAwesomeIcon);

Vue.use(Buefy, {
  defaultIconComponent: 'vue-fontawesome',
  defaultIconPack: 'fas',
})