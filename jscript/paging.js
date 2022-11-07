function ajaxPaging(urlVal,page,divid){
    if(urlVal.indexOf('?')>0)
    {
        urlVal=urlVal+"&page="+page;
    }
    else
    {
        urlVal=urlVal+"?page="+page;
    }
	
    $.ajax({
        url: urlVal,
        dataType:"json",
        cache: false,
        success: function(result){
            $("#"+divid).html(result.resultVar);
            window.scroll(0,200);
        },
        error: function(result)
        {            
            alert("Sorry some internal problem"+result.responseText);
        }
    });
}