
/* Hacemos que la fecha mínima que seleccione el usuario sea el día actual que quiere realizar la reserva */
let today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1; //January is 0!
let yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;

let search_date = document.getElementById("search_date");

search_date.min = today;