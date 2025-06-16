import{e as t}from"./funcoes-BcfOcYSN.js";import"./index-CnACay8y.js";$("#logout").click(function(){Swal.fire("Saindo..."),axios.post("logout").then(o=>{location.reload()}).catch(o=>t(o))});
