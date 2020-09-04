import Vue from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';
Vue.use(VueAxios, axios);

require('bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

Vue.component(
  'blog-component',
  require('./components/BlogComponent.vue').default
);

const app = new Vue({
  el: '#app',
  data() {
    return {
      categoryID: 0,
    };
  },
});

$(function() {
  $('#more-most-viewed').on('show.bs.collapse', function() {
    $('#remove-collapse').remove();
  });

  $('.tag-button').on('click', function() {
    $(this).css({ backgroundColor: $(this).data('color'), color: '#FFF' });
  });
});
