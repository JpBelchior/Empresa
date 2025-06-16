import { erro } from "../app";

$("#logout").click(function(){    
    Swal.fire("Saindo...");
    axios.post('logout')
    .then(response => { location.reload(); })
    .catch(error => erro(error))
});