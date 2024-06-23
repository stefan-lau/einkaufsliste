import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import App from './App.vue';

import "../css/app.scss";

const app = createApp(App);
app.mount("#app");
