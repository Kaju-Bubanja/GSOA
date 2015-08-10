function search(){
        console.log("Been here");
        console.log(targetUrl);
        var land = $('#laender').find(':selected').text();
        console.log(land);
       $.ajax({
                type:"POST",
                url: targetUrl,
                dataType: 'text',
                data: {landId: land},
                success: function(tab){
                    console.log(tab);
                    //console.log(searchData)
                    alert('success');
                },
                error: function (tab) {
                    alert('error');
                }
        });

}
