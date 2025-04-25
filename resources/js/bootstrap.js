import axios from 'axios';
import $ from 'jquery';
import 'jquery-mask-plugin';
import Swal from 'sweetalert2';
import TomSelect from 'tom-select';

//VARIÁVEIS GLOBAIS DA APLICAÇÃO
window.app_url = import.meta.env.VITE_API_URL;

//JQUERY
window.$ = $;

//TOM SELECT
window.TomSelect = TomSelect;

//AXIOS
/* let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; */
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.axios = axios;

//SWEETALERT
window.Swal = Swal;



