(()=>{function e(e,a,o){return a in e?Object.defineProperty(e,a,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[a]=o,e}$((function(a){var o;$("#company-list").DataTable((e(o={order:[[0,"desc"]]},"order",[]),e(o,"columnDefs",[{orderable:!1,targets:[0,6]}]),e(o,"language",{searchPlaceholder:"Search...",sSearch:""}),o)),$(".select2").select2({minimumResultsForSearch:1/0,width:"100%"}),$(".fc-datepicker").datepicker({dateFormat:"dd M yy",monthNamesShort:["Jan","Feb","Mar","Apr","Maj","Jun","Jul","Aug","Sep","Okt","Nov","Dec"],zIndex:999998}),$(document).ready((function(){$(".dismiss").on("click",(function(){$(".sidebar-modal").removeClass("active"),$("body").removeClass("overlay-open")})),$(".sidebarmodal-collpase").on("click",(function(){$(".sidebar-modal").addClass("active"),$("body").addClass("overlay-open")})),$("body").append('<div class="overlay"></div>'),$(".overlay").on("click touchstart",(function(){$("body").removeClass("overlay-open"),$(".sidebar-modal").removeClass("active")}))}))}))})();