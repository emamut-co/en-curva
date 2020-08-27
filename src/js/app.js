import Vue from 'vue';
import axios from 'axios';

require('bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

const app = new Vue({
  el: '#app',
});

$(function() {
  $('#more-most-viewed').on('show.bs.collapse', function() {
    $('#remove-collapse').remove();
  });
});
