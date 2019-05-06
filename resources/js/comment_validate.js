window.Vue = require('vue');


// import Form from './components/FormComponent.vue'

Vue.component('form-component', require('./components/FormComponent.vue'));
// const Form = require('./components/FormComponent.vue');


new Vue({
  el: '#comment_validate',
  // render: function(createElement) {
  //   return createElement(Form);
  // }
});