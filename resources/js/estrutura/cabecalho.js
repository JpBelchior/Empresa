import { erro } from "../app";

$("#logout").click(function(){    
    Swal.fire("Saindo...");
    axios.post(app_url+'/logout')
    .then(response => { location.reload(); })
    .catch(error => erro(error))
});