import axios from 'axios';
import $ from 'jquery';
import 'jquery-mask-plugin';
import Swal from 'sweetalert2';

//VARIÁVEIS GLOBAIS DA APLICAÇÃO
window.app_url = import.meta.env.VITE_API_URL;

//JQUERY
window.$ = $;

//AXIOS
let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
/* axios.defaults.headers.common['Cache-Control'] = 'no-cache, no-store, must-revalidate';
axios.defaults.headers.common['Pragma'] = 'no-cache';
axios.defaults.headers.common['Expires'] = '0'; */
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//SWEETALERT
window.Swal = Swal;



