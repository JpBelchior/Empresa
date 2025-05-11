$("#logout").click(function(){Swal.fire("Saindo..."),axios.post("logout").then(o=>{location.reload()}).catch(o=>erro(o))});
