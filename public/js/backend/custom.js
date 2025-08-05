
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        toastr.options = {
            "closeButton": true,
        }
        toastr.success('Copied to clipboard');
    }, function(err) {
        toastr.options = {
            "closeButton": true,
        }
        toastr.error(err);
    });
}