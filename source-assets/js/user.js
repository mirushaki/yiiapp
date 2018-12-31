$(document).ready(function(){

    function getSelectedRows()
    {
        return $('#w0').yiiGridView('getSelectedRows');
    }

        $('.btn-user-delete').on('click', function(){
            var keys = getSelectedRows();
            if (Array.isArray(keys) || keys.length) {
                this.attr("href", "/user/delete?ids=" + encodeURIComponent(JSON.stringify(keys)));
                return;
            }
            else
                return;
        })
    });