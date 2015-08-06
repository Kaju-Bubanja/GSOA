function search(){
        console.log("Been here");
        console.log(targetUrl);
       $.ajax({
                type:"POST",
                url: targetUrl,
                dataType: 'text',
                success: function(tab){
                    alert('success');
                },
                error: function (tab) {
                    alert('error');
                }
        });

}
