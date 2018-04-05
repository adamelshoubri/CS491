/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//includes for Survey Creator components
Vue.component('survey-creator', require('./components/SurveyCreator/SurveyCreator.vue'));
Vue.component('question-type', require('./components/SurveyCreator/Question.vue'));
Vue.component('text-question', require('./components/SurveyCreator/TextQuestion.vue'));
Vue.component('slider-question', require('./components/SurveyCreator/SliderQuestion.vue'));
Vue.component('radio-question', require('./components/SurveyCreator/RadioQuestion.vue'));
Vue.component('sortable-question', require('./components/SurveyCreator/SortableQuestion.vue'));
Vue.component('matrix-question', require('./components/SurveyCreator/MatrixQuestion.vue'));
Vue.component('skip-logic', require('./components/SurveyCreator/SkipLogic.vue'));

//includes for Survey Taker components
Vue.component('survey-taker', require('./components/SurveyTaker/SurveyTaker.vue'));
Vue.component('question', require('./components/SurveyTaker/Question.vue'));
Vue.component('short-text-question', require('./components/SurveyTaker/ShortTextQuestion.vue'));

const app = new Vue({
    el: '#app'
});
