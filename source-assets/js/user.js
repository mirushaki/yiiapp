$(document).ready(function(){

    function getSelectedRows()
    {
        return $('#w0').yiiGridView('getSelectedRows');
    }

        $('.btn-user-delete').on('click', function(){
            var keys = getSelectedRows();
            window.location.href = '/user/delete?ids=' + encodeURIComponent(JSON.stringify(keys));
        })
    });