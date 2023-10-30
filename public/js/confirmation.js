function confirmationSoft(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute("href");
    swal({
        title: "Bạn có chắc đưa vào thùng rác không ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willCancel) => {
        if (willCancel) {
            window.location.href = urlToRedirect;
        }
    });
}
function confirmationForce(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute("href");
    swal({
        title: "Bạn đã chắc chưa ?",
        text: "Sau khi xoá sẽ không thể khôi phục",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willCancel) => {
        if (willCancel) {
            window.location.href = urlToRedirect;
        }
    });
}
