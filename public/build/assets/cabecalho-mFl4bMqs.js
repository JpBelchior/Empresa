import{e as r}from"./funcoes-vPaU6AKm.js";import"./index-D9w9XwWd.js";$("#logout").click(function(){Swal.fire("Saindo..."),axios.post(app_url+"/logout").then(o=>{location.reload()}).catch(o=>r(o))});
