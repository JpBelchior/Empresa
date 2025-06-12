import axios from 'axios';
import $ from 'jquery';
import 'jquery-mask-plugin';
import Swal from 'sweetalert2';
import TomSelect from 'tom-select';

//VARIÁVEIS GLOBAIS DA APLICAÇÃO
window.app_url = import.meta.env.VITE_API_URL;
window.risco_altissimo = import.meta.env.VITE_RISCO_ALTISSIMO;
window.vulnerabilidade = import.meta.env.VITE_VULNERABILIDADE;

//JQUERY
window.$ = $;

//TOM SELECT
window.TomSelect = TomSelect;

//AXIOS
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.axios = axios;

//SWEETALERT
window.Swal = Swal;



