/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


// button delete
window.confirmDelete = function confirmDelete() {
    let button = confirm("Are you sure you want to delete?");
    if (button) {
        return true;
    }else {
        return false;
    }
}


const btnSlug = document.getElementById('btn-slugger');
if(btnSlug) {
    btnSlug.addEventListener('click', function () {
        const elementSlug = document.querySelector('#slug');
        const elementTitle = document.querySelector('#title').value;
        console.log('ciao');

        Axios.post('/admin/actionSlug', {data: elementTitle}).then(function (response) {
            elementSlug.value = response.data.slug;
        });
        console.log('ciao');
    });
}