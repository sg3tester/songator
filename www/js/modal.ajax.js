$('a[data-toggle="modal"]').on('click', function(){
    // update modal header with contents of button that invoked the modal
    $('#myModalLabel').html( $(this).html() );
    //fixes a bootstrap bug that prevents a modal from being reused
    $('#utility_body').load(
        $(this).attr('href'),
        function(response, status, xhr) {
            if (status === 'error') {
                //console.log('got here');
                $('#utility_body').html('<h2>Oh boy</h2><p>Sorry, but there was an error:' + xhr.status + ' ' + xhr.statusText+ '</p>');
            }
            return this;
        }
    );
});
