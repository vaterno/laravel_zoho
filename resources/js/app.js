import './bootstrap';
import { createApp } from 'vue'
import routes from "./routes.js";
import {defineRule} from "vee-validate";
import { required, min, max, url, integer } from '@vee-validate/rules';
import 'bootstrap/dist/css/bootstrap.css';

defineRule('required', required);
defineRule('min', min);
defineRule('max', max);
defineRule('url', url);
defineRule('integer', integer);

const app = createApp();
app.use(routes);
app.mount('#app')

