import{e as r}from"./funcoes-BcfOcYSN.js";import"./index-CnACay8y.js";$("#logout").click(function(){Swal.fire("Saindo..."),axios.post(app_url+"/logout").then(o=>{location.reload()}).catch(o=>r(o))});
