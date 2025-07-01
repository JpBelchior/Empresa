import{e as r}from"./funcoes-DyzI_Slr.js";import"./index-BxfsJSEQ.js";$("#logout").click(function(){Swal.fire("Saindo..."),axios.post(app_url+"/logout").then(o=>{location.reload()}).catch(o=>r(o))});
